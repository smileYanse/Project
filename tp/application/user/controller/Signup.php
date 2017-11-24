<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/13
 * Time: 11:05
 */

namespace app\user\controller;


use app\user\model\User;
use PHPMailer\PHPMailer\PHPMailer;
use think\Controller;
use think\Request;
use think\Session;

class Signup  extends Controller {

    public function index()
    {

        //是否是表单的提交--post
        if ($this->request->isPost())
        {
            $model = new User();
            $row = $model->signup($this->request->post());
            if ( ! $row)
            {
                $this->view->errors = $model->errors;
            } else
            {
                $this->success("注册成功", '/user/signin');
                exit();
            }
        }
        return $this->fetch();
    }

    /**
     * 发送邮件验证码
     */
    public function sendEmailCode()
    {

        $request = Request::instance();
        $email = $request->get('email');
        //判断是否是邮箱地址
        if (is_email($email) === FALSE)
        {
            $res = [
                'status' => 4001,
                'message' => '请输入合法的邮箱地址'
            ];
        } elseif ($this->checkSendEmailFrequency() === FALSE)
        {
            //判断邮件是否发送太频繁，60秒才能再次发送
            $res = [
                'status' => 4002,
                'message' => '发送太频繁，请稍等1分钟再重新发送'
            ];
        } else
        {
            //发送邮件验证码
            $row = $this->sendEmail($email, $this->generateEmailCode());
            if ($row)
            {
                $res = [
                    'status' => 2000,
                    'message' => '发送邮箱验证码成功'
                ];
            } else
            {
                $res = [
                    'status' => 4003,
                    'message' => '发送邮箱验证码失败'
                ];
            }
        }

        //$type = "json";
        //$response = Response::create($res, $type);
        //throw new HttpResponseException($response);

        return $res;
    }

    //判断验证码的发送时间
    protected function checkSendEmailFrequency()
    {

        return ! Session::get('email_code_last_sent') || (time() - Session::get('email_code_last_sent') > 60);
    }

    /**
     * 产生邮件验证码,并记录session
     */
    protected function generateEmailCode()
    {
        $code = creat_code(6);
        Session::set('email_code', $code);
        Session::set("email_code_last_sent", time());
        return $code;
    }

    /**
     * 对比邮件验证码
     * @param type $code
     * @return boolean
     */
    protected function verifyEmailCode($code)
    {
        $scode = Session::get('email_code');
        return $code === $scode;
    }

    /**
     * 发送邮件验证码
     */
    public function sendEmail($email, $code)
    {

        $mail = new PHPMailer();                              // Passing `true` enables exceptions
        //Server settings
        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = 'smtp.163.com';  // Specify main and backup SMTP servers
        $mail->SMTPAuth = TRUE;                               // Enable SMTP authentication
        $mail->CharSet = 'utf-8';
        $mail->Username = '18538008237@163.com';                 // SMTP username
        $mail->Password = '123456abc';                           // SMTP password
        $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 25;                                    // TCP port to connect to

        //Recipients
        $mail->setFrom('18538008237@163.com', 'superking');
        $mail->addAddress($email, '打印云客户');     // Add a recipient

        //Content
        $mail->isHTML(TRUE);                                  // Set email format to HTML
        $mail->Subject = '打印云注册验证码';
        $mail->Body = "<h3>验证码:</h3><h1>$code</h1>";

        return $mail->send();

    }

}