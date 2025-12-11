<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

$arComponentParameters = [
    'GROUPS' => [
        'IBLOCK' => ['NAME' => 'Источник (инфоблок)'],
    ],
    'PARAMETERS' => [
        'TITLE' => [
            'PARENT' => 'BASE',
            'NAME' => 'Заголовок блока',
            'TYPE' => 'STRING',
        ],
        'IBLOCK_TYPE' => [
            'PARENT' => 'IBLOCK',
            'NAME' => 'Тип инфоблока',
            'TYPE' => 'STRING',
        ],
        'IBLOCK_ID' => [
            'PARENT' => 'IBLOCK',
            'NAME' => 'ID инфоблока',
            'TYPE' => 'STRING',
            'DEFAULT' => '0',
        ],
        'ITEMS' => [
            'PARENT' => 'DATA_SOURCE',
            'NAME' => 'Элементы (массив для моков, если IBLOCK_ID=0)',
            'TYPE' => 'STRING',
            'MULTIPLE' => 'Y',
            'DEFAULT' => [],
        ],
        'CACHE_TIME' => ['DEFAULT' => 3600],
    ],
];

