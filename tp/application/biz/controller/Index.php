<?php
namespace app\biz\controller;
use app\biz\model\Biz;
use app\user\model\Orders;
use think\Request;
use app\user\model\OrderGoods;
use app\user\model\OrderTimeline;
class Index extends BizBase
{
    public function index()
    {
        $limit = 10;
        $this->view->subtitle = "商家订单";
        $Orders = new Orders();
        $list = $Orders->getBixOrderListByUid($this->userInfo['b_id'], $limit);

        $this->view->list = $list;
        return $this->fetch();
    }

    public function loginOut(){
        Biz::loginOut();
        $this->success('登出成功','/index/index');
        exit;
    }

    public function orderinfo() {
        $request = Request::instance();
        $id = $request->param("id", "", "intval");
        if (!$id) {
            $this->error("ID参数错误");
            die();
        }

        //订单信息
        $Orders = new Orders();
        $oRes = $Orders->getOrderInfoByIdAndBid($id, $this->userInfo['b_id']);
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

    public function orderconfirm(){
        //1.获取订单ID参数，并过滤和判断
        $oid = request()->post("oid/d");
        if (!$oid) {
            $this->error("oid参数错误");
        }

        //2.获取订单信息，并判断a.订单是否存在;b.订单是否是自己的;3.订单是否已完成支付
        $Orders  = new Orders();
        $oRes = $Orders->getOrderInfoByIdAndBid($oid, $this->userInfo['b_id']);
        if (!$oRes){
            $this->error("指定oid的订单不存在");
        }

        //确认
        $uRes = $Orders->changeOrderState($oRes, $this->userInfo['b_username'],'produce');
        if ($uRes) {
            $this->success("确认成功");
        }
    }

    public function orderprint(){
        //1.获取订单ID参数，并过滤和判断
        $oid = request()->post("oid/d");
        if (!$oid) {
            $this->error("oid参数错误");
        }

        //2.获取订单信息，并判断a.订单是否存在;b.订单是否是自己的;3.订单是否已完成支付
        $Orders  = new Orders();
        $oRes = $Orders->getOrderInfoByIdAndBid($oid, $this->userInfo['b_id']);
        if (!$oRes){
            $this->error("指定oid的订单不存在");
        }

        //确认
        $uRes = $Orders->changeOrderState($oRes, $this->userInfo['b_username'],'delivery');
        if ($uRes) {
            $this->success("打印成功");
        }
    }


}
