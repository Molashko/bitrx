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
            // TODO: здесь позже будет выборка из инфоблока
            $this->arResult['TITLE'] = $this->arParams['TITLE'];
            $this->arResult['ITEMS'] = $this->prepareItems($this->arParams['ITEMS']);
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

