<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}
?>
<ul class="nav__list footer__nav-list">
  <?php foreach ($arResult as $item): ?>
    <li>
      <a class="nav__link<?= $item['SELECTED'] ? ' nav__link--accent' : '' ?>" href="<?= htmlspecialcharsbx($item['LINK']) ?>">
        <span><?= htmlspecialcharsbx($item['TEXT']) ?></span>
      </a>
    </li>
  <?php endforeach; ?>
</ul>

