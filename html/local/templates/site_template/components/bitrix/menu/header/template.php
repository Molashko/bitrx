<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}
?>
<ul class="nav__list menu-mobile__list">
  <?php foreach ($arResult as $item): ?>
    <li>
      <a class="nav__link<?= $item['SELECTED'] ? ' nav__link--accent' : '' ?> menu-mobile__link" href="<?= htmlspecialcharsbx($item['LINK']) ?>">
        <?php if ($item === reset($arResult)): ?>
          <div class="nav__link-icon burger tab-hidden">
            <span></span><span></span><span></span>
          </div>
        <?php endif; ?>
        <span><?= htmlspecialcharsbx($item['TEXT']) ?></span>
      </a>
      <svg class="menu-mobile__link-icon">
        <use xlink:href="<?= SITE_TEMPLATE_PATH ?>/assets/sprite.svg#icon-arrow-extra-min"></use>
      </svg>
    </li>
  <?php endforeach; ?>
</ul>

