<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/18
 * Time: 15:05
 */

namespace app\biz\model;
use think\Validate;
use traits\model\SoftDelete;

use think\Model;
use think\Session;
class Biz extends Model {

    public $errors = false;
    //时间戳
    protected $autoWriteTimestamp = 'datetime';
    //软删除
    use SoftDelete;
    protected $deleteTime = 'delete_time';

    //根据经纬度范围获取,列表
    function getList($range){
        //min_x(纬度lat) min_y(精度lng) max_x max_y
        $res = $this->field("b_id as seller_id, b_name as seller_name, b_address as seller_address, b_lng as seller_lng, b_lat as seller_lat")
            ->where("b_lng", [">=", $range['min_lng']], ["<=", $range['max_lng']])
            ->where("b_lat", [">=", $range['min_lat']], ["<=", $range['max_lat']])
            ->select();
        return collection($res)->toArray();
    }

    //登录
    public function signin($data){

        $rule =[
            'username'=>'require',
            'passwd'=>'require',
            'captcha'=>'captcha'];
        $msg = [
            'username.require' => '请填写用户名',
            'passwd.require' => '请填密码',
            'captcha.require' => '请填验证码',
        ];
        //规则,错误信息
       $validate = new Validate($rule,$msg);
       $res = $validate->batch()->check($data);

        if (FALSE === $res){
            $this->errors = $validate->getError();
            return FALSE;
        }

        //判断用户名和密码
        $user = Biz::where('b_username',$data['username'])->find();

        if (!$user){
            $this->errors['username'] = '用户名不存在';
            return FALSE;
        }
        if ($user['b_password']!==md5($data['passwd'])){
            $this->errors['passwd'] = '用户名或密码不匹配';
            return FALSE;
        }
        $this->setAuth($user);
        return TRUE;
    }


    protected function setAuth($row) {
        $auth = $row['b_id'] . "-" . $row['b_password'];
        Session::set('biz_auth', $auth);
    }

    /**
     * 获取Auth
     * @return type
     */
    protected function getAuth() {
        return Session::get('biz_auth');
    }

    /**
     * 根据SESSION的auth获取用户信息
     */
    public function getAuthInfo() {
        $auth = $this->getAuth();
        if (!$auth) {
            return false;
        }

        if (strpos($auth, "-") === false) {
            return false;
        }

        list($id, $pass) = explode("-", $auth);
        if (empty($id) || (strlen($pass) != 32)) {
            return false;
        }

        $where = [
            'b_id' => $id,
            'b_password' => $pass
        ];
        $row = $this->where($where)->find();
        return $row;
    }

    /**
     * 检查Auth
     */
    public function checkAuth() {
        $row = $this->getAuthInfo();
        if (!$row) {
            return false;
        }
        return true;
    }

    static public function loginOut(){
        Session::delete('biz_auth');
    }

}