<?php
$arUrlRewrite=array (
  1 => 
  array (
    'CONDITION' => '#^\\/?\\/mobileapp/jn\\/(.*)\\/.*#',
    'RULE' => 'componentName=$1',
    'ID' => NULL,
    'PATH' => '/bitrix/services/mobileapp/jn.php',
    'SORT' => 100,
  ),
  3 => 
  array (
    'CONDITION' => '#^/bitrix/services/ymarket/#',
    'RULE' => '',
    'ID' => '',
    'PATH' => '/bitrix/services/ymarket/index.php',
    'SORT' => 100,
  ),
  0 => 
  array (
    'CONDITION' => '#^/stssync/calendar/#',
    'RULE' => '',
    'ID' => 'bitrix:stssync.server',
    'PATH' => '/bitrix/services/stssync/calendar/index.php',
    'SORT' => 100,
  ),
  6 => 
  array (
    'CONDITION' => '#^/personal/order/#',
    'RULE' => '',
    'ID' => 'bitrix:sale.personal.order',
    'PATH' => '/personal/order/index.php',
    'SORT' => 100,
  ),
  7 => 
  array (
    'CONDITION' => '#^/personal/#',
    'RULE' => '',
    'ID' => 'bitrix:sale.personal.section',
    'PATH' => '/personal/index.php',
    'SORT' => 100,
  ),
  5 => 
  array (
    'CONDITION' => '#^/catalog/#',
    'RULE' => '',
    'ID' => 'bitrix:catalog',
    'PATH' => '/catalog/index.php',
    'SORT' => 100,
  ),
  8 => 
  array (
    'CONDITION' => '#^/store/#',
    'RULE' => '',
    'ID' => 'bitrix:catalog.store',
    'PATH' => '/store/index.php',
    'SORT' => 100,
  ),
  2 => 
  array (
    'CONDITION' => '#^/rest/#',
    'RULE' => '',
    'ID' => NULL,
    'PATH' => '/bitrix/services/rest/index.php',
    'SORT' => 100,
  ),
  9 => 
  array (
    'CONDITION' => '#^/catalog/([\\w\\-]+)/([\\w\\-]+)/?#',
    'RULE' => 'ELEMENT_CODE=$2&SECTION_CODE=$1',
    'ID' => 'project:catalog.section',
    'PATH' => '/catalog/element.php',
    'SORT' => 100,
  ),
  10 => 
  array (
    'CONDITION' => '#^/catalog/([\\w\\-]+)/?#',
    'RULE' => 'SECTION_CODE=$1',
    'ID' => 'project:catalog.section',
    'PATH' => '/catalog/index.php',
    'SORT' => 100,
  ),
  11 => 
  array (
    'CONDITION' => '#^/faq/#',
    'RULE' => '',
    'ID' => 'project:faq.list',
    'PATH' => '/faq/index.php',
    'SORT' => 100,
  ),
);
