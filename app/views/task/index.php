<?php
/**
 * User: Gredasow Iwan (Griff19)
 * Date: 20.03.2021
 * Time: 3:08
 * @var $models models\Task
 * @var $count integer
 * @var $page integer
 * @var $sort integer
 */
use griff\Helper;

?>

<div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
    <h1 class="display-4">Задачи</h1>
    <p class="lead">Вы можете создать задачу</p>
</div>
<div class="row">
    <div class="col-md-4">
        <a class="btn btn-primary mb-3" href="<?= Helper::url('task/create')?>">Создать задачу</a>
    </div>
    <div class="col-md-8">
        <p>Соритровать по Имени:
            <a class="link" href="<?= Helper::url('task/index', ['page' => $page, 'sort' => 1])?>">Возр.</a>
            <a class="link" href="<?= Helper::url('task/index', ['page' => $page, 'sort' => 2])?>">Убыв.</a>
            по Email:
            <a class="link" href="<?= Helper::url('task/index', ['page' => $page, 'sort' => 3])?>">Возр.</a>
            <a class="link" href="<?= Helper::url('task/index', ['page' => $page, 'sort' => 4])?>">Убыв.</a>
            по Статусу:
            <a class="link" href="<?= Helper::url('task/index', ['page' => $page, 'sort' => 5])?>">Возр.</a>
            <a class="link" href="<?= Helper::url('task/index', ['page' => $page, 'sort' => 6])?>">Убыв.</a>
        </p>
    </div>
</div>
<div class="row row-cols-1 row-cols-md-3 mb-3 text-center">
    <?php
    if (!$models) {
        echo "Задач пока нет...";
    } else
    foreach ($models as $model){ ?>
        <div class="col">
            <div class="card mb-4 shadow-sm">
                <div class="card-header">
                    <a href="<?= Helper::url('task/view', ['id' => $model['id']])?>">
                        <?php if ($model['edit']) {?>
                            <span class="badge bg-secondary">Изменен</span>
                        <?php } ?>
                        <span class="badge  <?= $model['performed'] ? "bg-success tye" : "bg-warning text-dark" ?> ">
                            <?= $model['performed'] ? "Готово": "Ожидает"?>
                        </span>
                        <h4 class="my-0 fw-normal">
                            <?= $model['user_name']?>
                        </h4>
                    </a>
                </div>
                <div class="card-body">
                    <h5 class="card-subtitle mb-2 text-muted"><?= $model['email']?></h5>
                    <?= $model['text_task']?>
                </div>
            </div>
        </div>
    <?php } ?>
</div>

<div class="row">
<?php if ($count > 3){ ?>
    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center">
            <li class="page-item <?= ($page == 1)? 'disabled' : ''?>" >
                <a class="page-link"
                   href="<?= Helper::url('task/index', ['page' => $page-1, 'sort' => $sort])?>"
                   aria-disabled="<?= ($page == 1)? "true" : "false"?>"> << </a>
            </li>
            
            <?php for ($i = 1; $i < ($count / 3 + 1); $i++) {
                $active = ($page == $i) ? "active": "";
                echo '<li class="page-item '. $active .'">';
                echo '<a class="page-link" href="'.Helper::url('task/index', ['page' => $i, 'sort' => $sort]).'">'. $i .'</a>';
                echo '</li>';
            } ?>
            
            <li class="page-item <?= ($page >= $count / 3)? 'disabled"': '"'?>">
                <a class="page-link"
                   href="<?= Helper::url('task/index', ['page' => $page+1, 'sort' => $sort])?>"
                   aria-disabled=<?= ($page >= $count/3)? "true" : "false"?>> >> </a>
            </li>
        </ul>
    </nav>
<?php } ?>
</div>

