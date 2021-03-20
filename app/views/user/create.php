<?php
/**
 * Created by PhpStorm.
 * User: Gredasow Iwan (Griff19)
 * Date: 23.04.2018
 * Time: 18:33
 */

use griff\T;
use griff\Asset;
use griff\Helper;

if (array_key_exists('user', $GLOBALS)) {
    $user = unserialize($GLOBALS['user']);
    unset($GLOBALS['user']);
}
?>
<div>
    <h2><?= T::t('FILL_OUT_FORM')?></h2>
    <form enctype="multipart/form-data" action="<?= Helper::url('user/create')?>" method="post"
          onsubmit="return validForm();">
        <label class="form-label" for="login"> * <?= T::t('USR_LOGIN')?>: </label><br/>
        <input class="form-control" id="login" name="login" type="text" value="<?= isset($user) ? $user->login : '' ?>" size="20" maxlength="255"
               onblur="validLogin()">
        <div id="err_log" class="error"></div>
        <br/>
        <label class="form-label" for="password"> * <?= T::t('USR_PASS')?>: </label><br/>
        <input class="form-control" id="password" name="password" type="password" size="20" maxlength="255" onblur="validPass1()">
        <div id="err_pass1" class="error"></div>
        <br/>
        <label class="form-label" for="password2"> * <?= T::t('CONFIRM_PASS')?>: </label><br/>
        <input class="form-control" id="password2" name="password2" type="password" size="20" maxlength="255" onblur="validPass2()">
        <div id="err_pass" class="error"></div>
        <br/>
        
        <label class="form-label" for="snp"> * <?= T::t('FULL_NAME')?>:</label><br/>
        <input class="form-control" id="snp" name="snp" type="text" value="<?= isset($user) ? $user->snp : '' ?>" size="40" maxlength="255"
               onblur="validSnp(this.value)"><br/>
        <div id="err_snp" class="error"></div>
        <br/>
        <label class="form-label" for="email"> <?= T::t('USR_EMAIL')?>: </label><br/>
        <input class="form-control" id="email" name="email" type="text" value="<?= isset($user) ? $user->email : '' ?>" size="40" maxlength="255"
               onblur="validEmail()">
        <div id="err_email" class="error"></div>
        <br/>
        
        <input type="hidden" name="MAX_FILE_SIZE" value="2000000" />
        <label class="form-label" for="user_file"><?= T::t('ADD_IMAGE')?>:</label><br/>
        <input class="form-control" id="user_file" name="user_file" type="file" accept="image/*"/><br/><br/>
        
        <label class="form-label" for="memo"><?= T::t('ABOUT_YOUSELF')?>:</label><br/>
        <textarea class="form-control" id="memo" name="memo" rows="3" cols="40"></textarea>
        <div id="err_memo" class="error"></div>
        <br/>
        <button class="btn btn-primary" type="submit"><?= T::t('SAVE')?></button>
    </form>
    <br/>
    <?= T::t('FIELDS_STARS')?>
</div>

<?php Asset::registerJsFile('app/js/sign_up.min.js', Asset::BODY)?>