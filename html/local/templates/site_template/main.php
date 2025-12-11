<?php
require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php');
?>

<?php
// Главная: подключаем динамические блоки через кастомные компоненты (пока мок-данные).

$APPLICATION->IncludeComponent(
    'project:cards.list',
    '',
    [
        'TITLE' => 'Популярные услуги',
        'ITEMS' => [
            ['TITLE' => 'Интеграция Битрикс', 'TEXT' => 'Настройка, внедрение и поддержка.', 'IMG' => SITE_TEMPLATE_PATH . '/assets/images/card-1.jpg', 'TAGS' => ['CRM', '24/7'], 'LINK' => '#'],
            ['TITLE' => 'Поддержка проектов', 'TEXT' => 'Сопровождение, SLA, развитие.', 'IMG' => SITE_TEMPLATE_PATH . '/assets/images/card-2.jpg', 'TAGS' => ['Support'], 'LINK' => '#'],
            ['TITLE' => 'Разработка', 'TEXT' => 'Frontend/Backend, интеграции.', 'IMG' => SITE_TEMPLATE_PATH . '/assets/images/card-3.jpg', 'TAGS' => ['Dev'], 'LINK' => '#'],
        ],
    ],
    false,
    ['HIDE_ICONS' => 'Y']
);

$APPLICATION->IncludeComponent(
    'project:catalog.section',
    '',
    [
        'SECTION_TITLE' => 'Каталог решений',
        'SHOW_FILTER' => 'N',
        'ITEMS' => [
            [
                'TITLE' => 'Быстрый запуск интернет-магазина',
                'DESCRIPTION' => 'Готовое решение под ключ.',
                'PRICE' => 'от 120 000 ₽',
                'OLD_PRICE' => '',
                'IMG' => SITE_TEMPLATE_PATH . '/assets/images/card-4.jpg',
                'BADGES' => ['Новинка'],
            ],
            [
                'TITLE' => 'Корпоративный портал',
                'DESCRIPTION' => 'Автоматизация внутренних процессов.',
                'PRICE' => 'от 180 000 ₽',
                'OLD_PRICE' => '210 000 ₽',
                'IMG' => SITE_TEMPLATE_PATH . '/assets/images/card-5.jpg',
                'BADGES' => ['Акция'],
            ],
            [
                'TITLE' => 'Bitrix24: интеграция',
                'DESCRIPTION' => 'Подключение телефонии, аналитики, омниканала.',
                'PRICE' => 'от 90 000 ₽',
                'OLD_PRICE' => '',
                'IMG' => SITE_TEMPLATE_PATH . '/assets/images/card-6.jpg',
                'BADGES' => ['Hit'],
            ],
        ],
    ],
    false,
    ['HIDE_ICONS' => 'Y']
);

$APPLICATION->IncludeComponent(
    'project:faq.list',
    '',
    [
        'TITLE' => 'Ответы на вопросы',
        'ITEMS' => [
            ['QUESTION' => 'Как быстро запустите проект?', 'ANSWER' => 'Зависит от объёма. Для типового сайта — от 2 недель, для портала — индивидуально.'],
            ['QUESTION' => 'Работаете по SLA?', 'ANSWER' => 'Да, можем зафиксировать SLA на поддержку и развитие.'],
            ['QUESTION' => 'Есть рассрочка/этапность?', 'ANSWER' => 'Да, разбиваем проект на этапы и сдаём по частям.'],
        ],
    ],
    false,
    ['HIDE_ICONS' => 'Y']
);
?>

<?php
require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php');

