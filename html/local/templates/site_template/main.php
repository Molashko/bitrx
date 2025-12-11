<?php
require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php');
?>
<?php
// TODO: сюда будет перенесён контент главной страницы из статики через компоненты/инфоблоки.
// Для временного отображения можно подключить включаемую область:
$APPLICATION->IncludeComponent(
    'bitrix:main.include',
    '',
    [
        'AREA_FILE_SHOW' => 'file',
        'PATH' => SITE_TEMPLATE_PATH . '/includes/main-placeholder.php',
    ],
    false,
    ['HIDE_ICONS' => 'Y']
);
?>
<?php
require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php');

