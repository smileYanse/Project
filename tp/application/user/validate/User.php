<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/13
 * Time: 15:50
 */

namespace app\user\validate;


use think\Session;
use think\Validate;

class User extends Validate {

    protected $rule = [
        'username' => 'require|min:4|max:25|unique:user',
        'passwd' => 'require|min:6',
        'passwd_r' => 'require|confirm:passwd',
        'email' => 'require|email|unique:user,email',
        'email_code' => 'require|checkEmailCode',
        'captcha'=>'captcha'
    ];
    protected $message = [
        'username.require' => '请填写用户名',
        'username.min' => '用户名最少4个字符',
        'username.max' => '用户名最长25个字符',
        'username.unique' => '用户名已存在',
        'passwd.require' => '请填写密码',
        'passwd.min' => '密码最少6个字符',
        'passwd_r.require' => '请填写确认密码',
        'passwd_r.confirm' => '两次输入密码不一致',
        'email.require' => '请输入邮箱',
        'email.email' => '请输入合法的邮箱地址',
        'email.unique' => '邮箱已存在',
        'captcha.require'=>'请输入验证码',
        'captcha.captcha'=>'验证码错误'
    ];
    protected $scene = [
        'signup'=>['username','passwd','passwd_r','email','email_code'],
        'signin'=>['username'=>'require|checkUsername','passwd'=>'require','captcha'],
    ];

    //自定义验证方法
    protected function checkEmailCode($email_code){

//        if (empty($email_code) || !Session::get('email_code')) {
//            return [
//                'email_code' => '请填写验证码'
//            ];
//        }
        if ($email_code !== Session::get('email_code')) {
            return [
                'email_code' => '验证码错误'
            ];
        }
        return true;
    }

    //检查用户名
    protected function checkUsername($username){

        $user = \app\user\model\User::getByUsername($username);
        if (!$user){
            return [
                'username'=>'用户名不存在'
            ];
        }
        return TRUE;
    }

}