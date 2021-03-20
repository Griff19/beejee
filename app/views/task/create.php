<?php
/**
 * User: Gredasow Iwan (Griff19)
 * Date: 20.03.2021
 * Time: 3:32
 */

use griff\T;
use griff\Helper;
?>

<h1>Создать новую задачу</h1>
<form action="<?= Helper::url('task/create')?>" method="post">
    <label for="user_name" class="form-label"> * <?= T::t('USER')?>: </label><br/>
    <input class="form-control" id="user_name" name="user_name" type="text" value="" size="20" maxlength="255"
           onblur="">
    <div id="err_log" class="error"></div>
    <br/>

    <label for="email" class="form-label"> * <?= T::t('USR_EMAIL')?>: </label><br/>
    <input class="form-control" id="email" name="email" type="text" value="" size="40" maxlength="255"
           onblur="validEmail()">
    <div id="err_email" class="error"></div>
    <br/>

    <label for="text_tsk" class="form-label"> * <?= T::t('ENTER_TASK')?>:</label><br/>
    <textarea class="form-control" id="text_tsk" name="text_task" rows="3" cols="40"></textarea>
    <div id="err_memo" class="error"></div>
    <br/>
    
    <button type="submit" class="btn btn-primary mb-3"><?= T::t('SAVE')?></button>

</form>