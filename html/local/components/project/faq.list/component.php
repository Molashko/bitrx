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
        return $params;
    }

    public function executeComponent()
    {
        if ($this->StartResultCache()) {
            $this->arResult['TITLE'] = $this->arParams['TITLE'];
            $this->arResult['ITEMS'] = $this->prepareItems($this->arParams['ITEMS']);
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
}

