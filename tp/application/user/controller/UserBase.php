<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/13
 * Time: 14:54
 */

namespace app\user\controller;

//控制器基类
use think\Controller;
use app\user\model\User;
class UserBase extends Controller {
    //检查登录授权
    protected function _initialize()
    {
        $this->checkUserAuth();
        $this->checkUserAccess();

    }

    public function checkUserAuth() {
        $User = new User;
        $userInfo = $User->getAuthInfo();

        if (!$userInfo){
            $this->redirect("/user/signin");
            die();
        }
        $this->userInfo = $userInfo;
        $this->view->userInfo = $userInfo;
    }

    /**
     * 检查用户的接入权限
     */
    protected function checkUserAccess() {
        $User = new User();
        if(!$User->rbac($this->userInfo['id'])) {
            $this->error("对不起，您没有权限");
            die();
        } else {
            return true;
        }

    }
}