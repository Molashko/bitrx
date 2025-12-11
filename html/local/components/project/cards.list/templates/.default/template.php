<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}
$templatePath = SITE_TEMPLATE_PATH;
?>
<section class="section cards">
  <div class="container">
    <?php if (!empty($arResult['TITLE'])): ?>
      <div class="section__title"><?= htmlspecialcharsbx($arResult['TITLE']) ?></div>
    <?php endif; ?>
    <div class="cards__grid">
      <?php foreach ($arResult['ITEMS'] as $item): ?>
        <article class="card">
          <?php if (!empty($item['IMG'])): ?>
            <div class="card__image">
              <img src="<?= htmlspecialcharsbx($item['IMG']) ?>" alt="<?= htmlspecialcharsbx($item['TITLE']) ?>">
            </div>
          <?php endif; ?>
          <div class="card__content">
            <?php if (!empty($item['TAGS'])): ?>
              <div class="card__tags">
                <?php foreach ($item['TAGS'] as $tag): ?>
                  <span class="card__tag"><?= htmlspecialcharsbx($tag) ?></span>
                <?php endforeach; ?>
              </div>
            <?php endif; ?>
            <?php if (!empty($item['TITLE'])): ?>
              <h3 class="card__title"><?= htmlspecialcharsbx($item['TITLE']) ?></h3>
            <?php endif; ?>
            <?php if (!empty($item['TEXT'])): ?>
              <p class="card__text"><?= htmlspecialcharsbx($item['TEXT']) ?></p>
            <?php endif; ?>
            <?php if (!empty($item['LINK'])): ?>
              <a class="button button--light card__link" href="<?= htmlspecialcharsbx($item['LINK']) ?>">Подробнее</a>
            <?php endif; ?>
          </div>
        </article>
      <?php endforeach; ?>
    </div>
  </div>
</section>

