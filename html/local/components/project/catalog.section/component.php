<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

class ProjectCatalogSectionComponent extends CBitrixComponent
{
    public function onPrepareComponentParams($params)
    {
        $params['CACHE_TIME'] = $params['CACHE_TIME'] ?? 3600;
        $params['SECTION_TITLE'] = $params['SECTION_TITLE'] ?? '';
        $params['SHOW_FILTER'] = ($params['SHOW_FILTER'] ?? 'Y') === 'Y';
        $params['ITEMS'] = is_array($params['ITEMS']) ? $params['ITEMS'] : [];
        return $params;
    }

    public function executeComponent()
    {
        if ($this->StartResultCache()) {
            // TODO: заменить mock на выборку из ИБ
            $this->arResult['SECTION_TITLE'] = $this->arParams['SECTION_TITLE'];
            $this->arResult['SHOW_FILTER'] = $this->arParams['SHOW_FILTER'];
            $this->arResult['ITEMS'] = $this->prepareItems($this->arParams['ITEMS']);
            $this->IncludeComponentTemplate();
        }
    }

    protected function prepareItems(array $items): array
    {
        // Структура моков: ['TITLE','PRICE','OLD_PRICE','IMG','BADGES'=>[],'DESCRIPTION']
        return array_map(static function ($item) {
            return [
                'TITLE' => $item['TITLE'] ?? '',
                'PRICE' => $item['PRICE'] ?? '',
                'OLD_PRICE' => $item['OLD_PRICE'] ?? '',
                'IMG' => $item['IMG'] ?? '',
                'BADGES' => $item['BADGES'] ?? [],
                'DESCRIPTION' => $item['DESCRIPTION'] ?? '',
            ];
        }, $items);
    }
}

