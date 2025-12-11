<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}
?>
<section class="section faq">
  <div class="container">
    <?php if (!empty($arResult['TITLE'])): ?>
      <div class="section__title"><?= htmlspecialcharsbx($arResult['TITLE']) ?></div>
    <?php endif; ?>
    <div class="faq__list">
      <?php foreach ($arResult['ITEMS'] as $idx => $item): ?>
        <div class="faq__item" data-accordion>
          <button class="faq__question" type="button" data-accordion-toggle>
            <span><?= htmlspecialcharsbx($item['QUESTION']) ?></span>
            <svg class="faq__icon">
              <use xlink:href="<?= SITE_TEMPLATE_PATH ?>/assets/sprite.svg#icon-arrow-extra-min"></use>
            </svg>
          </button>
          <div class="faq__answer" data-accordion-content>
            <p><?= htmlspecialcharsbx($item['ANSWER']) ?></p>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

