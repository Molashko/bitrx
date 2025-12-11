<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

$arComponentParameters = [
    'GROUPS' => [
        'IBLOCK' => ['NAME' => 'Источник (инфоблок)'],
    ],
    'PARAMETERS' => [
        'SECTION_TITLE' => [
            'PARENT' => 'BASE',
            'NAME' => 'Заголовок раздела',
            'TYPE' => 'STRING',
        ],
        'SHOW_FILTER' => [
            'PARENT' => 'BASE',
            'NAME' => 'Показывать фильтр',
            'TYPE' => 'CHECKBOX',
            'DEFAULT' => 'Y',
        ],
        'IBLOCK_ID' => [
            'PARENT' => 'IBLOCK',
            'NAME' => 'ID инфоблока каталога/услуг',
            'TYPE' => 'STRING',
            'DEFAULT' => '0',
        ],
        'SECTION_ID' => [
            'PARENT' => 'IBLOCK',
            'NAME' => 'ID раздела',
            'TYPE' => 'STRING',
            'DEFAULT' => '',
        ],
        'SECTION_CODE' => [
            'PARENT' => 'IBLOCK',
            'NAME' => 'CODE раздела',
            'TYPE' => 'STRING',
            'DEFAULT' => '',
        ],
        'PAGE_SIZE' => [
            'PARENT' => 'BASE',
            'NAME' => 'Элементов на странице',
            'TYPE' => 'STRING',
            'DEFAULT' => '12',
        ],
        'ITEMS' => [
            'PARENT' => 'DATA_SOURCE',
            'NAME' => 'Мок-данные товаров/услуг (если IBLOCK_ID=0)',
            'TYPE' => 'STRING',
            'MULTIPLE' => 'Y',
            'DEFAULT' => [],
        ],
        'CACHE_TIME' => ['DEFAULT' => 3600],
    ],
];

