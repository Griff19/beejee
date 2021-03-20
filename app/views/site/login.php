<?php
/**
 * Login form
 */
use griff\T;
use griff\App;
?>

<h2> <?= T::t('ENTER_LOGIN_AND_PASSWORD')?> </h2>

<form action="<?= App::$root ?>site/login" method="post">
    <div class="row">
        <label class="col-sm-2 col-form-label"> <?= T::t('USR_LOGIN')?>: </label><br/>
        <div class="col-sm-10">
            <input class="form-control" name="login" type="text" size="15" maxlength="15"><br/>
        </div>
        <label class="col-sm-2 col-form-label"> <?= T::t('USR_PASS')?>: </label><br/>
        <div class="col-sm-10">
            <input class="form-control" name="password" type="password" size="15" maxlength="15"><br/><br/>
        </div>
        
        <input class="btn btn-primary mt-3 mb-3" type="submit" value="<?= T::t('LINK_SIGN_IN')?>"><br/><br/>
    </div>
</form>

<p>
    <?= T::t('OR_YOU_CAN')?>
    <a href="<?= App::$root ?>user/create"><?= T::t('REGISTER')?></a>
    <?= T::t('IN_THE_SYSTEM')?>
</p>