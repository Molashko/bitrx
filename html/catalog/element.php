<?php
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');
$APPLICATION->SetTitle("Карточка");
?>
<?php
// Пока используется шаблон element.php (статический). Можно подключить отдельный detail-компонент, когда будет готов.
include $_SERVER['DOCUMENT_ROOT'] . SITE_TEMPLATE_PATH . '/element.php';
?>
<?php
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php');

