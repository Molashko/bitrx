<?php
require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php');
?>

<?php
// Шаблон раздела каталога/услуг: подключаем компонент catalog.section (пока мок-данные).
$APPLICATION->SetTitle("Каталог");

$APPLICATION->IncludeComponent(
    'project:catalog.section',
    '',
    [
        'SECTION_TITLE' => 'Каталог',
        'SHOW_FILTER' => 'N',
        'ITEMS' => [
            [
                'TITLE' => 'Услуга 1',
                'DESCRIPTION' => 'Описание услуги 1',
                'PRICE' => 'от 50 000 ₽',
                'OLD_PRICE' => '',
                'IMG' => SITE_TEMPLATE_PATH . '/assets/images/card-1.jpg',
                'BADGES' => ['Hit'],
            ],
            [
                'TITLE' => 'Услуга 2',
                'DESCRIPTION' => 'Описание услуги 2',
                'PRICE' => 'от 70 000 ₽',
                'OLD_PRICE' => '85 000 ₽',
                'IMG' => SITE_TEMPLATE_PATH . '/assets/images/card-2.jpg',
                'BADGES' => ['Акция'],
            ],
            [
                'TITLE' => 'Услуга 3',
                'DESCRIPTION' => 'Описание услуги 3',
                'PRICE' => 'от 95 000 ₽',
                'OLD_PRICE' => '',
                'IMG' => SITE_TEMPLATE_PATH . '/assets/images/card-3.jpg',
                'BADGES' => ['Новинка'],
            ],
        ],
    ],
    false,
    ['HIDE_ICONS' => 'Y']
);
?>

<?php
require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php');

