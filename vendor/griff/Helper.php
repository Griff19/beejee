<?php
/**
 * Class Helper
 *
 */
namespace griff;

class Helper
{
    /**
     * Secure string
     * @param $str
     * @return string
     */
    public static function safetyStr($str)
    {
        $s = trim($str);
        $s = strip_tags($s);
        $s = htmlspecialchars($s, ENT_QUOTES);
        $s = stripslashes($s);
        return $s;
    }
    
    public static function url($url, $params = null)
    {
        $str_param = '';
        if ($params){
            $str_param = '?'. http_build_query($params);
        }
        return App::$root . $url . $str_param;
    }
}