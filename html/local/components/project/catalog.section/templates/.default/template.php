<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}
?>
<section class="section catalog">
  <div class="container">
    <?php if (!empty($arResult['SECTION_TITLE'])): ?>
      <div class="section__title"><?= htmlspecialcharsbx($arResult['SECTION_TITLE']) ?></div>
    <?php endif; ?>

    <?php if ($arResult['SHOW_FILTER']): ?>
      <div class="catalog__filter">
        <!-- TODO: подключить реальный фильтр (см. верстку). Пока заглушка -->
        <div class="catalog__filter-placeholder">Фильтр будет подключён к данным ИБ</div>
      </div>
    <?php endif; ?>

    <div class="catalog__grid">
      <?php foreach ($arResult['ITEMS'] as $item): ?>
        <article class="card catalog__card">
          <?php if (!empty($item['IMG'])): ?>
            <div class="card__image">
              <img src="<?= htmlspecialcharsbx($item['IMG']) ?>" alt="<?= htmlspecialcharsbx($item['TITLE']) ?>">
            </div>
          <?php endif; ?>
          <div class="card__content">
            <?php if (!empty($item['BADGES'])): ?>
              <div class="card__tags">
                <?php foreach ($item['BADGES'] as $badge): ?>
                  <span class="card__tag"><?= htmlspecialcharsbx($badge) ?></span>
                <?php endforeach; ?>
              </div>
            <?php endif; ?>
            <?php if (!empty($item['TITLE'])): ?>
              <h3 class="card__title"><?= htmlspecialcharsbx($item['TITLE']) ?></h3>
            <?php endif; ?>
            <?php if (!empty($item['DESCRIPTION'])): ?>
              <p class="card__text"><?= htmlspecialcharsbx($item['DESCRIPTION']) ?></p>
            <?php endif; ?>
            <div class="card__price-block">
              <?php if (!empty($item['PRICE'])): ?>
                <span class="card__price"><?= htmlspecialcharsbx($item['PRICE']) ?></span>
              <?php endif; ?>
              <?php if (!empty($item['OLD_PRICE'])): ?>
                <span class="card__price-old"><?= htmlspecialcharsbx($item['OLD_PRICE']) ?></span>
              <?php endif; ?>
            </div>
            <a class="button button--light card__link" href="#">Подробнее</a>
          </div>
        </article>
      <?php endforeach; ?>
    </div>
  </div>
</section>

