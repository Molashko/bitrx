<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

$arComponentParameters = [
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
        'ITEMS' => [
            'PARENT' => 'DATA_SOURCE',
            'NAME' => 'Мок-данные товаров/услуг',
            'TYPE' => 'STRING',
            'MULTIPLE' => 'Y',
            'DEFAULT' => [],
        ],
        'CACHE_TIME' => ['DEFAULT' => 3600],
    ],
];

