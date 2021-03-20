<?php
/**
 * Created by PhpStorm.
 * User: Gredasow Iwan (Griff19)
 * Date: 23.04.2018
 * Time: 23:52
 */

namespace controllers;

use griff\T;
use griff\Controller;

class TranslatorController extends Controller
{
    public function actionT($str)
    {
        echo json_encode(T::t($str));
    }
    
    public function actionChLang($target)
    {
        T::setLang();
        $this->redirect($target);
    }
}
