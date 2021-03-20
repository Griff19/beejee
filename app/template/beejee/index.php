<?php
/* @var $content string */

use griff\Asset;
use griff\App;
use griff\Alert;
use griff\T;
use griff\Menu;
use models\User;

?>

<!doctype html>
<html lang="<?= T::t('LANG')?>">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="<?= T::t('TITLE_TEST')?>">
        <meta name="author" content="">
        <title><?= T::t('TITLE_TEST')?></title>
        <link rel="stylesheet" href="<?= App::$root ?><?= App::$config['template'] ?>/style.css">
        <link rel="icon" type="image/png" href="<?= App::$root ?><?= App::$config['template'] ?>/favicon.ico" />
        <?= Asset::addCss()?>
        <?= Asset::addJs(Asset::HEAD)?>
    </head>
    <body>
    <input type="hidden" id="root" value="<?= App::$root ?>">
    <header class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-body border-bottom shadow-sm">
        <p class="h5 my-0 me-md-auto fw-normal">Тестовое задание BeeJee</p>
        <nav class="nav my-2 my-md-0 me-md-3">
            <?php
            $menu = new Menu();
            $items[] = ['item' => [T::t('LINK_HOME') => 'task/index', 'title' => T::t('HOME_PAGE')]];
            $items[] = ['item' => [T::t('LINK_SIGN_IN') => 'site/login', 'visible' => !User::isLogin()]];
            $items[] = ['item' => [T::t('LINK_SIGN_UP') => 'user/create', 'visible' => !User::isLogin()]];
            if (User::isLogin())
                $items[] = ['item' => [T::t('LINK_PROFILE') . ' ('.App::user()->login.')' => 'user/view']];
            $items[] = ['item' => [T::t('LINK_EXIT') => 'site/logout', 'visible' => User::isLogin()]];
            $items[] = ['item' => [T::t('CH_LANGUAGE') => 'translator/ch-lang?target=' . App::getUrl(), 'title' => T::t('CH_LANG_TITLE')]];
    
            $menu->menu($items);
            ?>
            <!--
            <a class="p-2 text-dark" href="#">Features</a>
            <a class="p-2 text-dark" href="#">Enterprise</a>
            <a class="p-2 text-dark" href="#">Support</a>
            <a class="p-2 text-dark" href="#">Pricing</a>
            -->
        </nav>
        
    </header>
    
    <main class="container">
        <?php Alert::getFlash() ?>
        <?= $content ?>
    
        <footer class="pt-4 my-md-5 pt-md-5 border-top">
            <div class="row justify-content-between">
                <div class="col-md-6">
                    <p>2021 &copy; Gredasov Ivan <br /></p>
                </div>
                <div class="col-md-6" style="text-align: right">
                    <a href="mailto:griff19@mail.ru">ivan@gredasov.ru</a> <br />
                    <a href="https://github.com/Griff19">github.com/Griff19</a> <br />
                </div>
            </div>
        </footer>
    </main>

    <?= Asset::addJs(Asset::BODY)?>
    </body>
</html>
