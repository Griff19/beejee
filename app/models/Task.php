<?php
/**
 * User: Gredasow Iwan (Griff19)
 * Date: 20.03.2021
 * Time: 3:11
 */

namespace models;

use griff\Model;

/**
 * @property string user_name
 * @property string email
 * @property string text_task
 * @property boolean performed
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
            'id', 'user_name', 'email', 'text_task', 'performed'
        ];
    }
    
    public static function getSort($number)
    {
        $arr_sort = [
            0 => 'id',
            1 => 'user_name',
            2 => 'email',
            3 => 'performed DESC',
        ];
        
        return $arr_sort[$number];
    }
    
    
    
}