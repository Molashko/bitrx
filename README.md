# Базовое окружение Docker для 1С‑Битрикс

Поднимает связку nginx + php-fpm + MariaDB для установки 1С-Битрикс через уже лежащий `bitrixsetup.php` (файл перемещён в `html/`).

## Структура
- `docker-compose.yml` — состав сервисов.
- `html/` — корень сайта, тут лежит `bitrixsetup.php`.
- `docker/nginx/default.conf` — конфиг nginx.
- `docker/php/Dockerfile`, `php.ini`, `opcache.ini`, `entrypoint.sh` — образ PHP.
- `docker/db/conf.d/bitrix.cnf` — доп. настройки MariaDB.
- `docker/logs/*` — папки для логов (монтируются в контейнеры).

## Требования
- Docker / Docker Desktop.
- Порт 80 свободен (8025, 3306 — при необходимости для mailhog/DB).

## Быстрый старт
1) Убедитесь, что `html/bitrixsetup.php` на месте.  
2) При необходимости создайте `.env` (значения по умолчанию заданы в compose):  
   - `MYSQL_ROOT_PASSWORD`  
   - `MYSQL_DATABASE`  
   - `MYSQL_USER`  
   - `MYSQL_PASSWORD`  
   - `TZ` (по умолчанию `Europe/Moscow`)
3) Собрать и запустить: `docker compose up -d --build`
4) Открыть `http://localhost/bitrixsetup.php` и пройти мастер установки.  
   Параметры БД по умолчанию:  
   - Хост: `db`  
   - БД: `bitrix`  
   - Пользователь: `bitrix`  
   - Пароль: `bitrix`
5) После установки сайт доступен на `http://localhost/`.

## Сервисы
- `web` (nginx) — слушает 80 порт, отдаёт `/var/www/html`.
- `php` (php-fpm 8.1) — все требуемые расширения, Redis, cron установлен.
- `db` (MariaDB 10.11) — данные в `docker/db/data` (порт наружу не проброшен, чтобы избежать конфликта; при необходимости временно добавить `3306:3306` в `ports` или использовать `docker compose port db 3306`).
- Профили (не стартуют по умолчанию):  
  - `cron` — запуск cron: `docker compose --profile cron up -d cron`  
  - `redis` — кеш Redis: `docker compose --profile redis up -d redis`  
  - `mail` — MailHog на `http://localhost:8025`.

## Настройки PHP
Основные лимиты заданы в `docker/php/php.ini` (512M memory_limit, 64M upload/post, таймауты 300с). Opcache включён и настроен в `docker/php/opcache.ini`.

## Права и владельцы
`docker/php/entrypoint.sh` при старте контейнера:
- выставляет владельца `www-data:www-data` для `/var/www/html`;
- ставит 755 для каталогов и 644 для файлов;
- даёт 775 на типичные каталоги кеша/загрузок (`bitrix/cache`, `bitrix/managed_cache`, `bitrix/stack_cache`, `bitrix/tmp`, `upload`), если они существуют.

## Логи
- nginx: `docker/logs/nginx/`
- php-fpm: `docker/logs/php/`
- MariaDB: `docker/logs/db/`

## Бэкап (ручной)
- БД: `docker compose exec db sh -c "mysqldump -ubitrix -p$MYSQL_PASSWORD $MYSQL_DATABASE > /var/lib/mysql/backup.sql"` (файл появится в `docker/db/data`).
- Файлы: архивировать `html/`.

## Полезные команды
- Остановка: `docker compose down`
- Пересборка: `docker compose up -d --build`
- Консоль PHP: `docker compose exec php bash`
- Консоль БД: `docker compose exec db bash`

## Шаблон сайта (FASTonline)
- Шаблон: `html/local/templates/site_template/`
  - `header.php`, `footer.php`, `main.php`, `inner.php`, `section.php`, `element.php`
  - `assets/` (css, js, images, fonts, favicon, sprite)
  - `includes/*-placeholder.php` — временные заглушки, будут заменены компонентами/версткой.
- Подключены кастомные компоненты (пока с мок-данными, готовы к привязке ИБ):
  - `project:cards.list` — универсальные карточки.
  - `project:faq.list` — FAQ (аккордеон).
  - `project:form.simple` — форма (поля, чекбокс согласия).
  - `project:catalog.section` — список каталога/услуг (карточки, фильтр-заглушка).
  - Главная (`main.php`) использует эти компоненты; модалки в `footer.php` подключены через `form.simple`.
- Ассеты скопированы из `fastonline_static-main/docs/assets/` в `local/templates/site_template/assets/`.
- Подключение ассетов через `Bitrix\Main\Page\Asset` (см. header.php).
- Для переключения сайта на шаблон: Администрирование → Настройки → Сайты → Шаблоны сайтов → выбрать `site_template` для сайта (или прописать в `site`/`template` правила).
- Статика `fastonline_static-main/` будет удалена после полного переноса.

## Инфоблоки
- Скрипт создания ИБ: `local/scripts/install_iblocks.php`
  - Тип `content`, ИБ: `catalog`, `faq`, `promo`
  - Запуск: `docker compose exec php php -f /var/www/html/local/scripts/install_iblocks.php`
  - Обновляет `local/php_interface/iblocks.php` (константы IBLOCK_*).
- Используемые свойства:
  - catalog: PRICE, OLD_PRICE, BADGES (список), LINK
  - promo: LINK, TAGS
  - faq: вопрос (NAME), ответ (DETAIL_TEXT)

## ЧПУ / Маршрутизация
- `urlrewrite.php` добавлены правила для каталога и FAQ.
- Страницы:
  - `/catalog/` — список (section)
  - `/catalog/#SECTION_CODE#/` — список раздела
  - `/catalog/#SECTION_CODE#/#ELEMENT_CODE#/` — детальная (пока шаблон element.php)
  - `/faq/` — список FAQ

## Формы
- Компонент `project:form.simple` отправляет письмо через `Bitrix\Main\Mail\Mail` на RECIPIENT (или `email_from`), с серверной валидацией и защитой сессии.
- Для кастомизации получателя/темы: параметры `RECIPIENT`, `EVENT_SUBJECT`.

## После поднятия
- Запустить скрипт ИБ (см. выше), удостовериться в корректности ID в `local/php_interface/iblocks.php`.
- При необходимости настроить email_from и RECIPIENT для форм.

