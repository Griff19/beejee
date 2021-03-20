<?php
/* @var $content string */

use griff\Asset;
use griff\App;
use griff\Alert;
use griff\T;
use griff\Menu;
use models\User;

?>

<!DOCTYPE html>
<html lang="<?= T::t('LANG')?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?= App::$root ?><?= App::$config['template'] ?>/style.min.css">
    <?= Asset::addCss()?>
    <link rel="icon" type="image/png" href="<?= App::$root ?><?= App::$config['template'] ?>/favicon.ico" />
	
	<title><?= T::t('TITLE_TEST')?></title>
    <?= Asset::addJs(Asset::HEAD)?>
</head>
<body>
    <input type="hidden" id="root" value="<?= App::$root ?>">
	<div class="header">
		<h1 class="title"><?= T::t('TITLE_TEST')?></h1>
	</div>
	<div class="container menu">
    <?php
        $menu = new Menu();
        $items[] = ['item' => [T::t('LINK_HOME') => 'site/index', 'title' => T::t('HOME_PAGE')]];
        $items[] = ['item' => [T::t('LINK_SIGN_IN') => 'site/login', 'visible' => !User::isLogin()]];
        $items[] = ['item' => [T::t('LINK_SIGN_UP') => 'user/create', 'visible' => !User::isLogin()]];
        if (User::isLogin())
            $items[] = ['item' => [T::t('LINK_PROFILE') . ' ('.App::user()->login.')' => 'user/view']];
        $items[] = ['item' => [T::t('LINK_EXIT') => 'site/logout', 'visible' => User::isLogin()]];
        $items[] = ['item' => [T::t('CH_LANGUAGE') => 'translator/ch-lang?target=' . App::getUrl(), 'title' => T::t('CH_LANG_TITLE')]];
        
        $menu->menu($items);
    ?>
	</div>
 
	<div class="container content">
        <?php Alert::getFlash() ?>
        <?= $content ?>
	</div>
    
    <div class="footer">
        <p>2021 &copy; Gredasov Ivan <br />
        <a href="mailto:griff19@mail.ru">ivan@gredasov.ru</a> <br />
        <a href="https://github.com/Griff19">github.com/Griff19</a> <br />
        </p>
    </div>
    <?= Asset::addJs(Asset::BODY)?>
    
</body>
</html>