<?php
// Общая инициализация проекта FASTonline.

// Подключение автозагрузки composer, если появится.
$composerAutoload = $_SERVER['DOCUMENT_ROOT'] . '/local/vendor/autoload.php';
if (file_exists($composerAutoload)) {
    require_once $composerAutoload;
}

// Здесь можно регистрировать event handlers, helpers, DI-сервисы.

// Константы с ID инфоблоков (заполняются после запуска install-скрипта).
$iblocksConfig = __DIR__ . '/iblocks.php';
if (file_exists($iblocksConfig)) {
    include_once $iblocksConfig;
}

