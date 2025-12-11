<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

$arComponentParameters = [
    'PARAMETERS' => [
        'TITLE' => [
            'PARENT' => 'BASE',
            'NAME' => 'Заголовок формы',
            'TYPE' => 'STRING',
        ],
        'SUBTITLE' => [
            'PARENT' => 'BASE',
            'NAME' => 'Подзаголовок / текст',
            'TYPE' => 'STRING',
        ],
        'FIELDS' => [
            'PARENT' => 'DATA_SOURCE',
            'NAME' => 'Поля (массив)',
            'TYPE' => 'STRING',
            'MULTIPLE' => 'Y',
            'DEFAULT' => [],
        ],
        'BUTTON_TEXT' => [
            'PARENT' => 'BASE',
            'NAME' => 'Текст кнопки',
            'TYPE' => 'STRING',
            'DEFAULT' => 'Отправить',
        ],
        'SHOW_AGREEMENT' => [
            'PARENT' => 'ADDITIONAL_SETTINGS',
            'NAME' => 'Показывать чекбокс согласия',
            'TYPE' => 'CHECKBOX',
            'DEFAULT' => 'Y',
        ],
        'CACHE_TIME' => ['DEFAULT' => 0],
    ],
];

