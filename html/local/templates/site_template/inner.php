<?php
require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php');
?>

<?php
// Внутренняя страница «О проекте» — замена демо-контента на статическую страницу из старого wizards.
$APPLICATION->SetTitle("О проекте");
?>
<section class="section about">
  <div class="container">
    <h1>О проекте</h1>
    <p>Мы рады приветствовать вас на сайте компании Fast.online.</p>
    <p>Здесь будет размещён контент страницы «О проекте» из статики: преимущества, блоки доверия, призывы к действию. При необходимости сделаем подключение компонентов (карточки, отзывы, FAQ).</p>
  </div>
</section>

<?php
require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php');

