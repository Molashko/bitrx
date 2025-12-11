<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

$templatePath = SITE_TEMPLATE_PATH;
?>
  </main>
  <footer class="footer">
    <div class="container">
      <div class="footer__top">
        <a class="logo footer__logo" href="<?= SITE_DIR ?>">
          <img src="<?= $templatePath ?>/assets/images/logo-fast-online-light.svg" alt="FASTonline">
        </a>
          <div class="footer__copyright only-mobile">
            &#169; Fast.online 2023
          </div>
        <nav class="nav footer__nav">
          <?php
          $APPLICATION->IncludeComponent(
              'bitrix:menu',
              'footer',
              [
                  'ALLOW_MULTI_SELECT' => 'N',
                  'CHILD_MENU_TYPE' => 'left',
                  'DELAY' => 'N',
                  'MAX_LEVEL' => '1',
                  'MENU_CACHE_GET_VARS' => [],
                  'MENU_CACHE_TIME' => '3600',
                  'MENU_CACHE_TYPE' => 'A',
                  'MENU_CACHE_USE_GROUPS' => 'Y',
                  'ROOT_MENU_TYPE' => 'bottom',
                  'USE_EXT' => 'N',
              ],
              false,
              ['HIDE_ICONS' => 'Y']
          );
          ?>
        </nav>
        <a class="button button--fill footer__top-button" href="#" target="_blank">Войти в личный кабинет</a>
      </div>
      <div class="footer__bottom">
        <div class="footer__bottom-block">
          <div class="footer__copyright mob-hidden">
            &#169; Fast.online 2023
          </div>
          <div class="footer__pay-block">
            <a class="footer__pay-block-link" href="#">
              <svg>
                <use xlink:href="<?= $templatePath ?>/assets/sprite.svg#icon-mir"></use>
              </svg>
            </a>
            <a class="footer__pay-block-link" href="#">
              <svg>
                <use xlink:href="<?= $templatePath ?>/assets/sprite.svg#icon-visa"></use>
              </svg>
            </a>
            <a class="footer__pay-block-link" href="#">
              <svg>
                <use xlink:href="<?= $templatePath ?>/assets/sprite.svg#icon-mastercard"></use>
              </svg>
            </a>
          </div>
        </div>
        <div class="footer__bottom-block">
          <div class="footer__contacts">
            <div class="footer__contacts-item">
              <a class="footer__contacts-text-bold" href="tel:+78000000000">8 800 000 0000</a>
              <a class="footer__contacts-text footer__contacts-text--accent" data-fancybox href="#modalCallback">Заказать звонок</a>
            </div>
            <a class="footer__contacts-item" href="mailto:info@fast-online.ru">
              <p class="footer__contacts-text-bold">info@fast-online.ru</p>
              <p class="footer__contacts-text">по общим вопросам</p>
            </a>
          </div>
        </div>
      </div>
      <div class="footer__info">
        <a class="footer__info-link" href="#">Пользовательское соглашение</a>
        <a class="footer__info-link" href="#">Политика конфиденциальности</a>
        <a class="footer__info-link" href="#">Договор оферты</a>
      </div>
    </div>
  </footer>
  <button class="back-to-top" type="button" data-top>
    <svg class="back-to-top__icon">
      <use xlink:href="<?= $templatePath ?>/assets/sprite.svg#icon-arrow-extra-min"></use>
    </svg>
    <span class="back-to-top__text">Наверх</span>
  </button>
  <div hidden="hidden">
    <div class="modal" id="modalCallback">
      <button class="modal__close" type="button" data-fancybox-close>
        <svg class="modal__close-icon">
          <use xlink:href="<?= $templatePath ?>/assets/sprite.svg#icon-close"></use>
        </svg>
      </button>
      <?php
      $APPLICATION->IncludeComponent(
          'project:form.simple',
          '',
          [
              'TITLE' => 'Заказать обратный звонок',
              'FIELDS' => [
                  ['CODE' => 'name', 'LABEL' => 'Имя Отчество', 'TYPE' => 'text', 'REQUIRED' => 'Y', 'PLACEHOLDER' => 'Имя Отчество'],
                  ['CODE' => 'email', 'LABEL' => 'Email', 'TYPE' => 'email', 'REQUIRED' => 'N', 'PLACEHOLDER' => 'Email'],
                  ['CODE' => 'phone', 'LABEL' => 'Телефон', 'TYPE' => 'tel', 'REQUIRED' => 'Y', 'PLACEHOLDER' => 'Телефон'],
                  ['CODE' => 'comment', 'LABEL' => 'Комментарий...', 'TYPE' => 'textarea', 'REQUIRED' => 'N', 'PLACEHOLDER' => ''],
              ],
              'BUTTON_TEXT' => 'Отправить',
              'SHOW_AGREEMENT' => 'Y',
          ],
          false,
          ['HIDE_ICONS' => 'Y']
      );
      ?>
    </div>
    <div class="modal" id="modalRewiew">
      <button class="modal__close" type="button" data-fancybox-close>
        <svg class="modal__close-icon">
          <use xlink:href="<?= $templatePath ?>/assets/sprite.svg#icon-close"></use>
        </svg>
      </button>
      <?php
      $APPLICATION->IncludeComponent(
          'project:form.simple',
          '',
          [
              'TITLE' => 'Оставить отзыв',
              'FIELDS' => [
                  ['CODE' => 'name', 'LABEL' => 'Имя Отчество', 'TYPE' => 'text', 'REQUIRED' => 'Y', 'PLACEHOLDER' => 'Имя Отчество'],
                  ['CODE' => 'email', 'LABEL' => 'Email', 'TYPE' => 'email', 'REQUIRED' => 'N', 'PLACEHOLDER' => 'Email'],
                  ['CODE' => 'comment', 'LABEL' => 'Комментарий...', 'TYPE' => 'textarea', 'REQUIRED' => 'N', 'PLACEHOLDER' => ''],
              ],
              'BUTTON_TEXT' => 'Отправить',
              'SHOW_AGREEMENT' => 'Y',
          ],
          false,
          ['HIDE_ICONS' => 'Y']
      );
      ?>
    </div>
  </div>
</div>
</body>
</html>

