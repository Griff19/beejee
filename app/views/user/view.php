<?php
use griff\T;
use griff\App;
/**
 * @var $user models\User
 */
?>
<h1><?= T::t('PAGE_PROFILE') ?> "<?= $user->login ?>"</h1>
<div class="row">
    <div class="col-md-6">
        <div class="img-conteiner">
            <img class="img-thumbnail" src="<?= App::$root ?>app/<?= $user->link_file ?>" alt="<?= $user->snp ?>"/>
        </div>
    </div>
    
    <div class="col-md-6">
        <p><?= T::t('FULL_NAME')?>: <?= $user->snp ?></p>
        <p><?= T::t('USR_EMAIL')?>: <?= $user->email ?></p>
        <p><?= T::t('ADD_INFO')?>: <?= $user->memo ?></p>
    </div>
</div>
