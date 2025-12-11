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
        $params['RECIPIENT'] = $params['RECIPIENT'] ?? '';
        $params['EVENT_SUBJECT'] = $params['EVENT_SUBJECT'] ?? 'Заявка с сайта';
        return $params;
    }

    public function executeComponent()
    {
        $request = \Bitrix\Main\Context::getCurrent()->getRequest();
        $isPost = $request->isPost() && $request->getPost('project_form_simple') === 'Y';
        $this->arResult['ERRORS'] = [];
        $this->arResult['SUCCESS'] = false;

        $fieldsPrepared = $this->prepareFields($this->arParams['FIELDS']);

        if ($isPost) {
            if (!check_bitrix_sessid()) {
                $this->arResult['ERRORS'][] = 'Сессия истекла, обновите страницу.';
            } else {
                $data = [];
                foreach ($fieldsPrepared as $field) {
                    $code = $field['CODE'];
                    $value = trim((string)$request->getPost($code));
                    if ($field['REQUIRED'] && $value === '') {
                        $this->arResult['ERRORS'][] = 'Заполните поле: ' . $field['LABEL'];
                    }
                    $data[$code] = $value;
                }
                if (empty($this->arResult['ERRORS'])) {
                    $recipient = $this->arParams['RECIPIENT'] ?: \Bitrix\Main\Config\Option::get('main', 'email_from', '');
                    if ($recipient) {
                        $subject = $this->arParams['EVENT_SUBJECT'];
                        $lines = [];
                        foreach ($fieldsPrepared as $field) {
                            $code = $field['CODE'];
                            $label = $field['LABEL'] ?: $code;
                            $lines[] = $label . ': ' . ($data[$code] ?? '');
                        }
                        $body = "Форма: " . ($this->arParams['TITLE'] ?: 'Заявка') . "\n" . implode("\n", $lines);
                        $sent = \Bitrix\Main\Mail\Mail::send([
                            'TO' => $recipient,
                            'SUBJECT' => $subject,
                            'BODY' => $body,
                            'CHARSET' => 'UTF-8',
                            'CONTENT_TYPE' => 'text/plain',
                        ]);
                        $this->arResult['SUCCESS'] = $sent;
                        if (!$sent) {
                            $this->arResult['ERRORS'][] = 'Не удалось отправить письмо.';
                        }
                    } else {
                        $this->arResult['ERRORS'][] = 'Не задан e-mail получателя (RECIPIENT или email_from).';
                    }
                }
            }
        }

        if ($this->StartResultCache(false, [$this->arResult['SUCCESS'], $this->arResult['ERRORS']])) {
            $this->arResult['TITLE'] = $this->arParams['TITLE'];
            $this->arResult['SUBTITLE'] = $this->arParams['SUBTITLE'];
            $this->arResult['BUTTON_TEXT'] = $this->arParams['BUTTON_TEXT'];
            $this->arResult['SHOW_AGREEMENT'] = $this->arParams['SHOW_AGREEMENT'];
            $this->arResult['FIELDS'] = $fieldsPrepared;
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

