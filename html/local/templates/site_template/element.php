<?php
require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php');
?>

<?php
// Детальная страница (карточка) — пока статический вывод, позже подключим компонент detail.
$APPLICATION->SetTitle("Карточка");
?>
<section class="section element">
  <div class="container">
    <h1>Карточка элемента</h1>
    <div class="element__layout">
      <div class="element__image">
        <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/card-1.jpg" alt="">
      </div>
      <div class="element__content">
        <div class="element__tags">
          <span class="card__tag">Hit</span>
          <span class="card__tag">Новинка</span>
        </div>
        <h2>Название услуги/товара</h2>
        <p>Описание услуги/товара. Здесь будет реальное описание из инфоблока.</p>
        <div class="element__price">
          <span class="card__price">от 50 000 ₽</span>
          <span class="card__price-old">60 000 ₽</span>
        </div>
        <a class="button button--fill" href="#">Оформить</a>
      </div>
    </div>
  </div>
</section>

<?php
require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php');

