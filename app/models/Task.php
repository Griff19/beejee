<?php
/**
 * User: Gredasow Iwan (Griff19)
 * Date: 20.03.2021
 * Time: 3:11
 */

namespace models;

use griff\Alert;
use griff\App;
use griff\Model;
use griff\T;

/**
 * @property string user_name
 * @property string email
 * @property string text_task
 * @property boolean performed
 * @property boolean edit
 */
class Task extends Model
{
    public static function tableName()
    {
        return 'task';
    }
    
    public function fields()
    {
        return [
            'id', 'user_name', 'email', 'text_task', 'performed', 'edit'
        ];
    }
    
    public static function getSort($number)
    {
        $arr_sort = [
            0 => 'id',
            1 => 'user_name DESC',
            2 => 'user_name',
            3 => 'email DESC',
            4 => 'email',
            5 => 'performed',
            6 => 'performed DESC',
        ];
        
        return $arr_sort[$number];
    }
    
    public function validate($scenario = 'create')
    {
        if ($scenario == 'update') {
            if (User::isLogin() && App::user()->login == 'admin') {
            } else {
                Alert::setFlash('error', "Необходимо авторизоваться в системе");
                return false;
            }
        }
        
        $str_err = '';
        if (empty($this->user_name))
            $str_err = "Заполните имя пользователя <br>" ;
        
        if (empty($this->email))
            $str_err .= "Заполните email <br>";
        else
            if(!filter_var($this->email, FILTER_VALIDATE_EMAIL))
                $str_err .= "Email не соответствует формату <br>";
            
        if (empty($this->text_task))
            $str_err .= "Заполните текст задачи <br>";
    
        if (!empty($str_err)) {
            Alert::setFlash('error', $str_err);
            return false;
        } else {
            Alert::setFlash('success', "Задача успешно сохранена");
            return true;
        }
        
    }
    
    
    
}