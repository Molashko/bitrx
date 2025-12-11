<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

class ProjectFormSimpleComponent extends CBitrixComponent
{
    public function onPrepareComponentParams($params)
    {
        $params['CACHE_TIME'] = $params['CACHE_TIME'] ?? 0;
        $params['FIELDS'] = is_array($params['FIELDS']) ? $params['FIELDS'] : [];
        $params['TITLE'] = $params['TITLE'] ?? '';
        $params['SUBTITLE'] = $params['SUBTITLE'] ?? '';
        $params['BUTTON_TEXT'] = $params['BUTTON_TEXT'] ?? 'Отправить';
        $params['SHOW_AGREEMENT'] = ($params['SHOW_AGREEMENT'] ?? 'Y') === 'Y';
        return $params;
    }

    public function executeComponent()
    {
        if ($this->StartResultCache()) {
            $this->arResult['TITLE'] = $this->arParams['TITLE'];
            $this->arResult['SUBTITLE'] = $this->arParams['SUBTITLE'];
            $this->arResult['BUTTON_TEXT'] = $this->arParams['BUTTON_TEXT'];
            $this->arResult['SHOW_AGREEMENT'] = $this->arParams['SHOW_AGREEMENT'];
            $this->arResult['FIELDS'] = $this->prepareFields($this->arParams['FIELDS']);
            $this->IncludeComponentTemplate();
        }
    }

    protected function prepareFields(array $fields): array
    {
        // Ожидается структура: ['CODE'=>'name','LABEL'=>'Имя','TYPE'=>'text|email|tel|textarea','REQUIRED'=>'Y/N','PLACEHOLDER'=>'']
        return array_map(static function ($field) {
            return [
                'CODE' => $field['CODE'] ?? '',
                'LABEL' => $field['LABEL'] ?? '',
                'TYPE' => $field['TYPE'] ?? 'text',
                'REQUIRED' => ($field['REQUIRED'] ?? 'N') === 'Y',
                'PLACEHOLDER' => $field['PLACEHOLDER'] ?? '',
            ];
        }, $fields);
    }
}

