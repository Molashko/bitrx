<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

$arComponentParameters = [
    'PARAMETERS' => [
        'TITLE' => [
            'PARENT' => 'BASE',
            'NAME' => 'Заголовок блока',
            'TYPE' => 'STRING',
        ],
        'ITEMS' => [
            'PARENT' => 'DATA_SOURCE',
            'NAME' => 'Вопросы/ответы (массив)',
            'TYPE' => 'STRING',
            'MULTIPLE' => 'Y',
            'DEFAULT' => [],
        ],
        'CACHE_TIME' => ['DEFAULT' => 3600],
    ],
];

