<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

class ProjectFaqListComponent extends CBitrixComponent
{
    public function onPrepareComponentParams($params)
    {
        $params['CACHE_TIME'] = $params['CACHE_TIME'] ?? 3600;
        $params['ITEMS'] = is_array($params['ITEMS']) ? $params['ITEMS'] : [];
        $params['TITLE'] = $params['TITLE'] ?? '';
        $params['IBLOCK_ID'] = (int)($params['IBLOCK_ID'] ?? 0);
        return $params;
    }

    public function executeComponent()
    {
        if ($this->StartResultCache()) {
            if ($this->arParams['IBLOCK_ID'] > 0 && \Bitrix\Main\Loader::includeModule('iblock')) {
                $items = $this->loadFromIblock();
            } else {
                $items = $this->prepareItems($this->arParams['ITEMS']);
            }
            $this->arResult['TITLE'] = $this->arParams['TITLE'];
            $this->arResult['ITEMS'] = $items;
            $this->IncludeComponentTemplate();
        }
    }

    protected function prepareItems(array $items): array
    {
        // Структура: ['QUESTION' => '', 'ANSWER' => '']
        return array_map(static function ($item) {
            return [
                'QUESTION' => $item['QUESTION'] ?? '',
                'ANSWER' => $item['ANSWER'] ?? '',
            ];
        }, $items);
    }

    protected function loadFromIblock(): array
    {
        $items = [];
        $res = \CIBlockElement::GetList(
            ['SORT' => 'ASC', 'ID' => 'ASC'],
            ['IBLOCK_ID' => $this->arParams['IBLOCK_ID'], 'ACTIVE' => 'Y'],
            false,
            false,
            ['ID', 'NAME', 'DETAIL_TEXT']
        );
        while ($row = $res->GetNext()) {
            $items[] = [
                'QUESTION' => $row['NAME'],
                'ANSWER' => $row['DETAIL_TEXT'],
            ];
        }
        return $items;
    }
}

