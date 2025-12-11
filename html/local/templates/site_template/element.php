<?php
require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php');
?>
<?php
// Шаблон карточки элемента (детальная страница).
$APPLICATION->IncludeComponent(
    'bitrix:main.include',
    '',
    [
        'AREA_FILE_SHOW' => 'file',
        'PATH' => SITE_TEMPLATE_PATH . '/includes/element-placeholder.php',
    ],
    false,
    ['HIDE_ICONS' => 'Y']
);
?>
<?php
require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php');

