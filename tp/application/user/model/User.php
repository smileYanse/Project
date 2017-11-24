<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/13
 * Time: 14:39
 */

namespace app\user\model;


use think\Model;
use think\model\Collection;
use traits\model\SoftDelete;
use think\Session;

//1,登录
//2,注册
//3,权限
class User extends Model {

    //时间戳
    protected $autoWriteTimestamp = 'datetime';
    //软删除
    use SoftDelete;
    protected $deleteTime = 'delete_time';


    public $errors = false;

    //修改器
    public function setPasswdAttr($value){
        return md5($value);
    }

    //登录
    public function signin($data){

        $validate = new \app\user\validate\User();
        $res = $validate->scene('signin')->batch()->check($data);

        if (FALSE === $res){
            $this->errors = $validate->getError();
            return FALSE;
        }

        //判断用户名和密码
        $user = User::getByUsername($data['username']);

        if ($user['passwd']!==md5($data['passwd'])){
            $this->errors['passwd'] = '用户名或密码不匹配';
            return FALSE;
        }
        //记录授权
        $this->setAuth($user);
        return TRUE;
    }

    //注册
    public function signup($data){

        //使用验证器验证
        //参数见:validate点进去
        $res = $this->validate('User.signup',[],TRUE)
                    ->allowField(['username','passwd','email'])
                    ->save($data);

        if (FALSE === $res){
            $this->errors = $this->getError();
            return FALSE;
        }
        return TRUE;
    }

    //登录授权:已登录用户,自动授权访问各个页面
    /**
     * 设置Auth
     * @param type $row
     */
    protected function setAuth($row) {
        $auth = $row['id'] . "-" . $row['passwd'];
        Session::set('auth', $auth);
    }

    /**
     * 获取Auth
     * @return type
     */
    protected function getAuth() {
        return Session::get('auth');
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
            'id' => $id,
            'passwd' => $pass
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

    //登出
    static public function loginOut(){
        Session::delete('auth');
    }

    //权限管理
    /**
     * Rbac 访问权限
     */
    public function rbac($id) {

        $row = $this
            ->alias("u")
            ->join("role_user ru", "u.id = ru.user_id", "left")
            ->join("role r", "ru.role_id = r.id", "left")
            ->join("access a", "r.id = a.role_id", "left")
            ->join("node n", "a.node_id = n.id", "left")
            ->field("r.role_name, a.role_id, a.node_id, n.mca, n.name")
            ->where("u.id", $id)
            ->cache(60)
            ->select();

        //dump(Collection($row)->toArray());
        if (!$row) {
            return false;
        }
        $mcas = [];
        foreach ($row as $k => $v) {
            $mcas[$v['mca']] = $v->toArray();
        }
        $mcas_keys = array_keys($mcas);



        $request = request();
        $uri = strtolower($request->module() . "/" . $request->controller() . "/" . $request->action());

        if (!in_array($uri, $mcas_keys)) {
            return false;
        }
        return true;
    }

}