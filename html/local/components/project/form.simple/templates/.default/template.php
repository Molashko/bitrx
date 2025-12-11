<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}
?>
<div class="modal__inner">
  <?php if ($arResult['TITLE']): ?>
    <div class="modal__title"><?= htmlspecialcharsbx($arResult['TITLE']) ?></div>
  <?php endif; ?>
  <?php if ($arResult['SUBTITLE']): ?>
    <div class="modal__subtitle"><?= htmlspecialcharsbx($arResult['SUBTITLE']) ?></div>
  <?php endif; ?>
  <form class="form" action="#" data-form>
    <div class="form__block">
      <?php foreach ($arResult['FIELDS'] as $field): ?>
        <label>
          <?php if ($field['TYPE'] === 'textarea'): ?>
            <textarea
              name="<?= htmlspecialcharsbx($field['CODE']) ?>"
              placeholder="<?= htmlspecialcharsbx($field['PLACEHOLDER']) ?>"
              <?= $field['REQUIRED'] ? 'required' : '' ?>
            ></textarea>
          <?php else: ?>
            <input
              type="<?= htmlspecialcharsbx($field['TYPE']) ?>"
              name="<?= htmlspecialcharsbx($field['CODE']) ?>"
              placeholder="<?= htmlspecialcharsbx($field['PLACEHOLDER']) ?>"
              <?= $field['REQUIRED'] ? 'required' : '' ?>
            >
          <?php endif; ?>
          <?php if ($field['LABEL']): ?>
            <span><?= htmlspecialcharsbx($field['LABEL']) ?></span>
          <?php endif; ?>
        </label>
      <?php endforeach; ?>
    </div>
    <div class="form__block form__bottom">
      <?php if ($arResult['SHOW_AGREEMENT']): ?>
        <div class="form__agreement">
          <label>
            <input type="checkbox" name="agreement" data-form-agreement required>
          </label>
          <div class="">
            Соглашаюсь на обработку моих персональных данных в соответствии с
            <a href="#">Политикой конфиденциальности</a>
            и принимаю условия <a href="#">Пользовательского соглашения</a>
          </div>
        </div>
      <?php endif; ?>
      <button class="button button--fill button--full-wide" type="submit" data-form-submit>
        <?= htmlspecialcharsbx($arResult['BUTTON_TEXT']) ?>
      </button>
    </div>
    <div class="modal__msg" data-form-success>
      <div class="modal__msg-content">
        <svg class="modal__msg-icon">
          <use xlink:href="<?= SITE_TEMPLATE_PATH ?>/assets/sprite.svg#icon-success"></use>
        </svg>
        <div class="modal__msg-text">
          Сообщение успешно отправлено!
        </div>
      </div>
    </div>
    <div class="modal__msg" data-form-error>
      <div class="modal__msg-content">
        <svg class="modal__msg-icon">
          <use xlink:href="<?= SITE_TEMPLATE_PATH ?>/assets/sprite.svg#icon-error"></use>
        </svg>
        <div class="modal__msg-text">
          Упс! Что-то пошло не так, пожалуйста, попробуйте ещё раз.
        </div>
      </div>
    </div>
  </form>
</div>

