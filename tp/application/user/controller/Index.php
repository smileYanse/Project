<?php
namespace app\user\controller;

use app\user\model\User;
use think\Controller;
use think\Session;
use app\user\controller\UserBase;

use app\user\model\Orders;
use app\user\model\OrderGoods;
use app\user\model\OrderTimeline;
use think\Request;

class Index extends UserBase
{

    //订单列表
    public function index() {
        $limit = 10;
        $this->view->subtitle = "我的订单";
        $Orders = new Orders();
        $list = $Orders->getPageListByUid($this->userInfo['id'], $limit);

        $this->view->list = $list;
        return $this->fetch();
    }

    //订单详情
    public function orderinfo() {
        $request = Request::instance();
        $id = $request->param("id", "", "intval");
        if (!$id) {
            $this->error("ID参数错误");
            die();
        }

        //订单信息
        $Orders = new Orders();
        $oRes = $Orders->getOrderInfoByIdAndUid($id, $this->userInfo['id']);
        if (!$oRes) {
            $this->error("指定ID的订单不存在");
        }

        //订单的商品信息
        $OrderGoods = new OrderGoods();
        $ogRes = $OrderGoods->getInfoByOrderid($id);

        //订单的时间线信息
        $otRes = OrderTimeline::all([
            'ot_o_id' => $id
        ]);

        $this->view->oRes = $oRes;
        $this->view->ogRes = $ogRes;
        $this->view->otRes = $otRes;
        $this->view->subtitle = "订单信息";
        return $this->view->fetch();
    }

    //支付
    public function orderpay(){
        //1.获取订单ID参数，并过滤和判断
        $oid = request()->post("oid/d");
        if (!$oid) {
            $this->error("oid参数错误");
        }

        //2.获取订单信息，并判断a.订单是否存在;b.订单是否是自己的;3.订单是否已完成支付
        $Orders  = new Orders();
        $oRes = $Orders->getOrderInfoByIdAndUid($oid, $this->userInfo['id']);
        if (!$oRes){
            $this->error("指定oid的订单不存在");
        }
        if ($oRes['o_state'] !== 'create') {
            $this->error("指定oid的订单已完成支付");
        }
        //3.支付流程a.获取订单金额，获取用户余额，比较。b.用户扣钱.c.订单改为已支付.d订单时间线要加入日志。

        if ($oRes['o_pay_money'] > $this->userInfo['balance']) {
            $this->error("用户余额不足，请及时充值");
        }
        $uRes = $Orders->finishOrderPay($oRes, $this->userInfo);
        if ($uRes) {
            $this->success("支付成功");
        }
        //4.最好用事务完成

    }


    //领取
    public function receivedOrder(){
        //1.获取订单ID参数，并过滤和判断
        $oid = request()->post("oid/d");
        if (!$oid) {
            $this->error("oid参数错误");
        }

        //2.获取订单信息，并判断a.订单是否存在;b.订单是否是自己的;3.订单是否已完成支付
        $Orders  = new Orders();
        $oRes = $Orders->getOrderInfoByIdAndUid($oid, $this->userInfo['id']);
        if (!$oRes){
            $this->error("指定oid的订单不存在");
        }

        //确认
        $uRes = $Orders->changeOrderState($oRes, $this->userInfo['username'],'received');
        if ($uRes) {
            $this->success("已领取");
        }
    }

    //登出
    public function loginOut(){
        User::loginOut();
        $this->success('登出成功','/index/index');
        exit;
    }
}
