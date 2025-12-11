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
        'RECIPIENT' => [
            'PARENT' => 'ADDITIONAL_SETTINGS',
            'NAME' => 'E-mail получателя (если пусто — email_from из настроек)',
            'TYPE' => 'STRING',
            'DEFAULT' => '',
        ],
        'EVENT_SUBJECT' => [
            'PARENT' => 'ADDITIONAL_SETTINGS',
            'NAME' => 'Тема письма',
            'TYPE' => 'STRING',
            'DEFAULT' => 'Заявка с сайта',
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

