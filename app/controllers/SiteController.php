<?php
/**
 *
 */

namespace controllers;

use griff\Alert;
use griff\Controller;
use griff\T;
use models\User;

class SiteController extends Controller
{
    public $dir_view = 'site';
    
    public function actionIndex()
    {
        return $this->render('index');
    }
    
    public function actionLogin($success = false)
    {
        if (isset($_POST['login']) && isset($_POST['password'])) {
            $user = User::validUser($_POST['login'], $_POST['password']);
            if ($user) {
                $_SESSION['id']    = $user->user_token;
                $_SESSION['login'] = $user->login;
                $this->redirect('user/view');
            } else {
                Alert::setFlash('error', T::t('ACCESS_DENI'));
            }
        }
        return $this->render('login');
    }
    
    
    public function actionLogout()
    {
        session_destroy();
        return $this->redirect('task/index');
    }
    
    /**
     * @param string $message
     * @param int    $code
     */
    public function actionError($message = '', $code = 0)
    {
        $method = 0;
        switch ($code) {
            case 404:
                $header = $code . ' ' . T::t('PAGE_404', 'en');
                break;
            case 500:
                $header = $code . ' ' . T::t('PAGE_500', 'en');
                break;
            case 503:
                $header = $code . ' ' . T::t('PAGE_503', 'en');
                $method = 1;
                break;
            default:
                $header = 520 . " Unknown Error";
                $method = 1;
        }
        
        if ($method == 0) {
            return $this->render('error', ['header' => $header, 'message' => $message]);
        } else {
            return $this->renderAjax('error', ['header' => $header, 'message' => $message]);
        }
    }
}
