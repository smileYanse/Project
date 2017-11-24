<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/20
 * Time: 9:38
 */

namespace app\biz\controller;


use app\biz\model\Biz;
use think\Controller;

class Signin extends Controller {
    public function index(){

        if ($this->request->isPost())
        {
            $model = new Biz();
            $row = $model->signin($this->request->post());
            if ( ! $row)
            {
                $this->view->errors = $model->errors;
            } else
            {
                $this->success("登录成功", '/biz/index');
                exit();
            }
        }
        $this->view->subTitle = '商家登录';
        return $this->fetch('user@signin/index');
    }
}