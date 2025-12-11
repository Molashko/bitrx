<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

use Bitrix\Main\Page\Asset;

$templatePath = SITE_TEMPLATE_PATH;

Asset::getInstance()->addCss($templatePath . '/assets/css/main.css');
Asset::getInstance()->addJs($templatePath . '/assets/js/bundle.js');
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="apple-touch-icon" sizes="180x180" href="<?= $templatePath ?>/assets/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?= $templatePath ?>/assets/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="194x194" href="<?= $templatePath ?>/assets/favicon/favicon-194x194.png">
    <link rel="icon" type="image/png" sizes="192x192" href="<?= $templatePath ?>/assets/favicon/android-chrome-192x192.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= $templatePath ?>/assets/favicon/favicon-16x16.png">
    <link rel="manifest" href="<?= $templatePath ?>/assets/favicon/site.webmanifest">
    <link rel="mask-icon" href="<?= $templatePath ?>/assets/favicon/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="theme-color" content="#ffffff">
    <title><?php $APPLICATION->ShowTitle(); ?></title>
    <?php $APPLICATION->ShowHead(); ?>
</head>
<body class="body">
<?php $APPLICATION->ShowPanel(); ?>
<div class="main-container">
  <header class="header">
    <div class="container">
      <div class="header__block header__top">
        <a class="logo header__logo" href="<?= SITE_DIR ?>">
          <img src="<?= $templatePath ?>/assets/images/logo-fast-online.svg" alt="FASTonline">
        </a>
        <div class="search header__search mob-hidden">
          <form action="<?= SITE_DIR ?>search/">
            <label>
              <input type="search" name="q" placeholder="Поиск по сайту...">
            </label>
            <button class="search__button" type="submit">
              <svg class="search__button-icon">
                <use xlink:href="<?= $templatePath ?>/assets/sprite.svg#icon-search"></use>
              </svg>
            </button>
          </form>
        </div>
        <div class="header__callback">
          <div class="header__callback-link">
            <a class="header__callback-text" href="tel:+78000000000">8 800 000 0000</a>
            <a class="header__callback-text-underline" data-fancybox href="#modalCallback">Заказать звонок</a>
          </div>
        </div>
        <div class="header__toolbar">
          <a class="header__toolbar-link" href="#">
            <svg class="header__toolbar-icon">
              <use xlink:href="<?= $templatePath ?>/assets/sprite.svg#icon-fav"></use>
            </svg>
          </a>
          <div class="search header__search only-mobile">
            <form action="<?= SITE_DIR ?>search/">
              <label data-search-field-mobile>
                <input type="search" name="q" placeholder="Поиск по сайту...">
              </label>
              <button class="search__button" type="submit" tabindex="0" data-search-button-mobile>
                <svg class="search__button-icon">
                  <use xlink:href="<?= $templatePath ?>/assets/sprite.svg#icon-search"></use>
                </svg>
              </button>
            </form>
          </div>
          <a class="header__toolbar-link cart" href="#">
            <span class="cart__count">0</span>
            <svg class="header__toolbar-icon">
              <use xlink:href="<?= $templatePath ?>/assets/sprite.svg#icon-cart"></use>
            </svg>
          </a>
        </div>
        <div class="header__account">
          <a class="button--light header__account-link" href="#">
            <span>Войти</span>
            <svg class="header__account-icon">
              <use xlink:href="<?= $templatePath ?>/assets/sprite.svg#icon-enter"></use>
            </svg>
          </a>
        </div>
        <div class="header__menu-btn" data-toggle-menu>
          <span></span>
          <span></span>
          <span></span>
        </div>
      </div>
      <div class="header__block header__bottom menu-mobile" data-mobile-menu>
        <nav class="nav header__nav menu-mobile__nav">
          <?php
          $APPLICATION->IncludeComponent(
              'bitrix:menu',
              'header',
              [
                  'ALLOW_MULTI_SELECT' => 'N',
                  'CHILD_MENU_TYPE' => 'left',
                  'DELAY' => 'N',
                  'MAX_LEVEL' => '1',
                  'MENU_CACHE_GET_VARS' => [],
                  'MENU_CACHE_TIME' => '3600',
                  'MENU_CACHE_TYPE' => 'A',
                  'MENU_CACHE_USE_GROUPS' => 'Y',
                  'ROOT_MENU_TYPE' => 'top',
                  'USE_EXT' => 'N',
              ],
              false,
              ['HIDE_ICONS' => 'Y']
          );
          ?>
          <div class="menu-mobile__nav-bottom">
            <div class="header__account header__account--mobile">
              <a class="header__account-link" href="#">
                <span>Войти</span>
                <svg class="header__account-icon">
                  <use xlink:href="<?= $templatePath ?>/assets/sprite.svg#icon-enter"></use>
                </svg>
              </a>
            </div>
            <div class="header__callback header__callback--mobile">
              <div class="header__callback-link">
                <a class="header__callback-text" href="tel:+78000000000">8 800 000 0000</a>
                <a class="header__callback-text-underline" data-fancybox href="#modalCallback">Заказать звонок</a>
              </div>
            </div>
          </div>
        </nav>
      </div>
    </div>
  </header>
  <main class="page-content">

