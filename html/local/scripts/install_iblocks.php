<?php
// Скрипт создания типов и инфоблоков для FASTonline.
// Запуск из контейнера: docker compose exec php php -f /var/www/html/local/scripts/install_iblocks.php

$_SERVER['DOCUMENT_ROOT'] = realpath(__DIR__ . '/../../');
define('NO_KEEP_STATISTIC', true);
define('NOT_CHECK_PERMISSIONS', true);

require $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php';

use Bitrix\Iblock\IblockTable;
use Bitrix\Main\Loader;
use Bitrix\Main\IO\File;

if (!Loader::includeModule('iblock')) {
    echo "Module iblock not installed\n";
    exit(1);
}

$iblockType = 'content';
$iblocksToCreate = [
    [
        'CODE' => 'catalog',
        'NAME' => 'Каталог/Услуги',
        'FIELDS' => [
            'PREVIEW_PICTURE' => ['IS_REQUIRED' => 'N'],
            'DETAIL_PICTURE' => ['IS_REQUIRED' => 'N'],
        ],
        'PROPS' => [
            ['CODE' => 'PRICE', 'NAME' => 'Цена', 'PROPERTY_TYPE' => 'N'],
            ['CODE' => 'OLD_PRICE', 'NAME' => 'Старая цена', 'PROPERTY_TYPE' => 'N'],
            ['CODE' => 'BADGES', 'NAME' => 'Бейджи', 'PROPERTY_TYPE' => 'L', 'MULTIPLE' => 'Y', 'VALUES' => ['Hit', 'Новинка', 'Акция']],
            ['CODE' => 'LINK', 'NAME' => 'Ссылка', 'PROPERTY_TYPE' => 'S'],
        ],
    ],
    [
        'CODE' => 'faq',
        'NAME' => 'FAQ',
        'FIELDS' => [],
        'PROPS' => [],
    ],
    [
        'CODE' => 'promo',
        'NAME' => 'Промо/карточки',
        'FIELDS' => [
            'PREVIEW_PICTURE' => ['IS_REQUIRED' => 'N'],
        ],
        'PROPS' => [
            ['CODE' => 'LINK', 'NAME' => 'Ссылка', 'PROPERTY_TYPE' => 'S'],
            ['CODE' => 'TAGS', 'NAME' => 'Теги', 'PROPERTY_TYPE' => 'S', 'MULTIPLE' => 'Y'],
        ],
    ],
];

function ensureIblockType($id, $langName)
{
    $type = CIBlockType::GetByID($id)->Fetch();
    if ($type) {
        return true;
    }
    $obBlocktype = new CIBlockType;
    $arFields = [
        'ID' => $id,
        'SECTIONS' => 'Y',
        'IN_RSS' => 'N',
        'SORT' => 100,
        'LANG' => [
            'ru' => ['NAME' => $langName],
            'en' => ['NAME' => $langName],
        ],
    ];
    return (bool)$obBlocktype->Add($arFields);
}

function ensureIblock($type, $code, $name, $fields = [])
{
    $res = CIBlock::GetList([], ['CODE' => $code, 'TYPE' => $type]);
    if ($ib = $res->Fetch()) {
        return (int)$ib['ID'];
    }
    $ib = new CIBlock;
    $arFields = [
        'ACTIVE' => 'Y',
        'NAME' => $name,
        'CODE' => $code,
        'IBLOCK_TYPE_ID' => $type,
        'SITE_ID' => ['s1'],
        'SORT' => 100,
        'GROUP_ID' => ['2' => 'R'],
    ];
    if (!empty($fields)) {
        $arFields['FIELDS'] = [];
        foreach ($fields as $fieldCode => $fieldSettings) {
            $arFields['FIELDS'][$fieldCode] = array_merge(['IS_REQUIRED' => 'N'], $fieldSettings);
        }
    }
    $id = $ib->Add($arFields);
    return (int)$id;
}

function ensureProp($iblockId, $prop)
{
    $res = CIBlockProperty::GetList([], ['IBLOCK_ID' => $iblockId, 'CODE' => $prop['CODE']]);
    if ($res->Fetch()) {
        return;
    }
    $ibp = new CIBlockProperty;
    $fields = [
        'IBLOCK_ID' => $iblockId,
        'NAME' => $prop['NAME'],
        'ACTIVE' => 'Y',
        'SORT' => 100,
        'CODE' => $prop['CODE'],
        'PROPERTY_TYPE' => $prop['PROPERTY_TYPE'] ?? 'S',
        'MULTIPLE' => $prop['MULTIPLE'] ?? 'N',
    ];
    if (($prop['PROPERTY_TYPE'] ?? '') === 'L' && !empty($prop['VALUES'])) {
        $fields['VALUES'] = array_map(static function ($v, $sort) {
            return ['VALUE' => $v, 'SORT' => ($sort + 1) * 100];
        }, $prop['VALUES'], array_keys($prop['VALUES']));
    }
    $ibp->Add($fields);
}

function addDemoElements($iblockId, $code)
{
    $el = new CIBlockElement;
    if ($code === 'faq') {
        $items = [
            ['NAME' => 'Как быстро запустите проект?', 'DETAIL_TEXT' => 'Для типового сайта — от 2 недель. Для портала — индивидуально.'],
            ['NAME' => 'Работаете по SLA?', 'DETAIL_TEXT' => 'Да, можем зафиксировать SLA на поддержку и развитие.'],
            ['NAME' => 'Есть рассрочка/этапность?', 'DETAIL_TEXT' => 'Да, разбиваем проект на этапы.'],
        ];
    } elseif ($code === 'promo') {
        $items = [
            ['NAME' => 'Интеграция Битрикс', 'PREVIEW_TEXT' => 'Настройка, внедрение и поддержка.', 'PROPERTY_VALUES' => ['LINK' => '#', 'TAGS' => ['CRM', '24/7']]],
            ['NAME' => 'Поддержка проектов', 'PREVIEW_TEXT' => 'Сопровождение, SLA, развитие.', 'PROPERTY_VALUES' => ['LINK' => '#', 'TAGS' => ['Support']]],
            ['NAME' => 'Разработка', 'PREVIEW_TEXT' => 'Frontend/Backend, интеграции.', 'PROPERTY_VALUES' => ['LINK' => '#', 'TAGS' => ['Dev']]],
        ];
    } else { // catalog
        $items = [
            ['NAME' => 'Быстрый запуск интернет-магазина', 'PREVIEW_TEXT' => 'Готовое решение под ключ.', 'PROPERTY_VALUES' => ['PRICE' => '120000', 'OLD_PRICE' => '', 'BADGES' => ['Новинка']]],
            ['NAME' => 'Корпоративный портал', 'PREVIEW_TEXT' => 'Автоматизация внутренних процессов.', 'PROPERTY_VALUES' => ['PRICE' => '180000', 'OLD_PRICE' => '210000', 'BADGES' => ['Акция']]],
            ['NAME' => 'Bitrix24: интеграция', 'PREVIEW_TEXT' => 'Телефония, аналитика, омниканал.', 'PROPERTY_VALUES' => ['PRICE' => '90000', 'OLD_PRICE' => '', 'BADGES' => ['Hit']]],
        ];
    }
    foreach ($items as $item) {
        $exists = CIBlockElement::GetList([], ['IBLOCK_ID' => $iblockId, 'NAME' => $item['NAME']])->Fetch();
        if ($exists) {
            continue;
        }
        $item['IBLOCK_ID'] = $iblockId;
        $item['ACTIVE'] = 'Y';
        $el->Add($item);
    }
}

// Создание типа
if (!ensureIblockType($iblockType, 'Контент')) {
    echo "Не удалось создать тип инфоблока\n";
    exit(1);
}

$ids = [];
foreach ($iblocksToCreate as $ib) {
    $id = ensureIblock($iblockType, $ib['CODE'], $ib['NAME'], $ib['FIELDS']);
    if ($id > 0) {
        foreach ($ib['PROPS'] as $prop) {
            ensureProp($id, $prop);
        }
        addDemoElements($id, $ib['CODE']);
    }
    $ids[$ib['CODE']] = $id;
    echo "IB {$ib['CODE']} => {$id}\n";
}

// Записываем ID в local/php_interface/iblocks.php
$configPath = $_SERVER['DOCUMENT_ROOT'] . '/local/php_interface/iblocks.php';
$content = "<?php\n";
$content .= "define('IBLOCK_CATALOG_ID', " . (int)$ids['catalog'] . ");\n";
$content .= "define('IBLOCK_FAQ_ID', " . (int)$ids['faq'] . ");\n";
$content .= "define('IBLOCK_PROMO_ID', " . (int)$ids['promo'] . ");\n";
File::putFileContents($configPath, $content);

echo "Готово. Обновлены ID в local/php_interface/iblocks.php\n";

