<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/13
 * Time: 11:05
 */

namespace app\user\controller;

use app\user\model\User;
use think\Controller;

class Signin extends Controller {
    public function index(){

        if ($this->request->isPost())
        {
            $model = new User();
            $row = $model->signin($this->request->post());
            if ( ! $row)
            {
                $this->view->errors = $model->errors;
            } else
            {
                $this->success("登录成功", '/user/index');
                exit();
            }
        }
        $this->view->subTitle = '用户登录';

        return $this->fetch();
    }
}