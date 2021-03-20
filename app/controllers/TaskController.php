<?php
/**
 * User: Gredasow Iwan (Griff19)
 * Date: 20.03.2021
 * Time: 3:34
 */

namespace controllers;

use griff\Alert;
use griff\Controller;
use griff\T;
use models\Task;

class TaskController extends Controller
{
    public function actionIndex($page = 1, $sort = 0)
    {
        if (!is_numeric($sort)) {
            $sort = 0;
        }
        
        $models = Task::findAll($page, Task::getSort($sort));
        $count  = Task::getCount();
        
        return $this->render('index', [
            'models' => $models,
            'count' => $count,
            'page' => $page,
            'sort' => $sort
        ]);
    }
    
    public function actionView($id)
    {
        $model = Task::findOne($id);
        return $this->render('view', ['model' => $model]);
    }
    
    public function actionCreate()
    {
        $model = new Task();
        
        if ($model->load($_POST)) {
            if ($model->save()) {
                Alert::setFlash('success', T::t('TASK') . ' ' . T::t('ADDED_TASK'));
            } else {
                Alert::setFlash('error', T::t('ERROR'));
            }
            return $this->redirect('task/index');
        }
        
        return $this->render('create');
    }
    
    public function actionUpdate($id)
    {
        $model     = Task::findOne($id);
        $new_model = new Task();
        
        if ($new_model->load($_POST)) {
            if (isset($_POST['performed'])) {
                $new_model->performed = true;
            }
            
            if ($new_model->update()) {
                return $this->redirect('task/index');
            }
        }
        
        return $this->render('update', ['model' => $model]);
        
    }
}
