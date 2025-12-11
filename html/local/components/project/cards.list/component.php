<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

use Bitrix\Main\Loader;
use Bitrix\Main\Errorable;
use Bitrix\Main\Error;

class ProjectCardsListComponent extends CBitrixComponent implements Errorable
{
    /** @var Error[] */
    protected $errors = [];

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
            $items = [];
            if ((int)$this->arParams['IBLOCK_ID'] > 0 && Loader::includeModule('iblock')) {
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
        // Ожидается структура: ['TITLE' => '', 'TEXT' => '', 'IMG' => '', 'LINK' => '', 'TAGS' => []]
        return array_map(static function ($item) {
            return [
                'TITLE' => $item['TITLE'] ?? '',
                'TEXT' => $item['TEXT'] ?? '',
                'IMG' => $item['IMG'] ?? '',
                'LINK' => $item['LINK'] ?? '#',
                'TAGS' => $item['TAGS'] ?? [],
            ];
        }, $items);
    }

    protected function loadFromIblock(): array
    {
        $items = [];
        $res = \CIBlockElement::GetList(
            ['SORT' => 'ASC', 'ID' => 'ASC'],
            ['IBLOCK_ID' => (int)$this->arParams['IBLOCK_ID'], 'ACTIVE' => 'Y'],
            false,
            false,
            ['ID', 'NAME', 'PREVIEW_TEXT', 'PREVIEW_PICTURE', 'DETAIL_PAGE_URL', 'PROPERTY_LINK', 'PROPERTY_TAGS']
        );
        while ($row = $res->GetNext()) {
            $img = '';
            if (!empty($row['PREVIEW_PICTURE'])) {
                $file = \CFile::GetPath($row['PREVIEW_PICTURE']);
                if ($file) {
                    $img = $file;
                }
            }
            $items[] = [
                'TITLE' => $row['NAME'],
                'TEXT' => $row['PREVIEW_TEXT'],
                'IMG' => $img,
                'LINK' => $row['PROPERTY_LINK_VALUE'] ?: $row['DETAIL_PAGE_URL'] ?: '#',
                'TAGS' => is_array($row['PROPERTY_TAGS_VALUE']) ? $row['PROPERTY_TAGS_VALUE'] : array_filter([$row['PROPERTY_TAGS_VALUE']]),
            ];
        }
        return $items;
    }

    public function getErrors()
    {
        return $this->errors;
    }

    public function getErrorByCode($code)
    {
        foreach ($this->errors as $error) {
            if ($error->getCode() === $code) {
                return $error;
            }
        }
        return null;
    }
}

