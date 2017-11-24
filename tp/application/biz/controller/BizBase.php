<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/20
 * Time: 9:53
 */

namespace app\biz\controller;


use app\biz\model\Biz;
use think\Controller;

class BizBase extends Controller {
//检查登录授权
    protected function _initialize()
    {
        $this->checkUserAuth();
    }

    public function checkUserAuth() {
        $User = new Biz();
        $userInfo = $User->getAuthInfo();

        if (!$userInfo){
            $this->redirect("/biz/signin");
            die();
        }
        $this->userInfo = $userInfo;
        $this->view->userInfo = $userInfo;
    }
}