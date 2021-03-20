<?php
/**
 * User: Gredasow Iwan (Griff19)
 * Date: 20.03.2021
 * Time: 11:52
 * @var $model models\Task
 *
 */
use models\User;
use griff\App;
use griff\Helper;

?>

<h1>Задача №<?= $model->id ?></h1>
<?php if (User::isLogin() && App::user()->login == 'admin'){ ?>
    <a class="btn btn-primary mb-3" href="<?= Helper::url('task/update', ['id' => $model->id])?>">Редактировать</a>
<?php } ?>

<p>Пользователь: <?= $model->user_name ?></p>
<p>E-mail: <?= $model->email ?></p>
<p>Текст задачи: <?= $model->text_task ?></p>
