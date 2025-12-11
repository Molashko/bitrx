<?php
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');
$APPLICATION->SetTitle("FAQ");
?>
<?php
$APPLICATION->IncludeComponent(
    'project:faq.list',
    '',
    [
        'TITLE' => 'Вопрос-ответ',
        'IBLOCK_ID' => IBLOCK_FAQ_ID,
    ],
    false,
    ['HIDE_ICONS' => 'Y']
);
?>
<?php
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php');

