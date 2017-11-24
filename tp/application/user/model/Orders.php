<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/18
 * Time: 16:43
 */

namespace app\user\model;


use app\biz\model\Biz;
use think\Model;
use think\Db;
use traits\model\SoftDelete;

class Orders extends Model {
    //时间戳
    protected $autoWriteTimestamp = 'datetime';
    //软删除
    use SoftDelete;
    protected $deleteTime = 'delete_time';

    //订单包含的商品
    protected $name_order_goods = "order_goods";
    //订单流程
    protected $name_order_timeline = "order_timeline";

    /**
     * 提交订单
     */
    public function submitOrder($files, $bid, $userInfo) {
        Db::startTrans();
        //计算价格
        $printFilesFee = $this->caclPrintFilesFee($files);
        //订单号
        $order_id = $userInfo->id.date('YmdHis').mt_rand(0,60);
        //先创建订单
        $odata = [
            'o_state' => 'create',
            'o_pay_type' => 'online',
            'o_b_id' => $bid,
            'o_delivery_type' => 'self',
            'o_delivery_fee' => 0,
            'o_goods_money' => $printFilesFee,
            'o_pay_money' => $printFilesFee,
            'o_delivery_address' => '',
            'o_uid' => $userInfo['id'],
        ];
        $orow = $this->save($odata);

        //保存订单中的商品
        $ogdata = [];
        foreach ($files as $k => $v) {
            $file['og_o_id'] = $this->o_id;
            $file['og_f_id'] = $v['fid'];
            $file['og_start_page'] = $v['start_page'];
            $file['og_end_page'] = $v['end_page'];
            $file['og_color'] = $v['color'];
            $file['og_two_sided'] = $v['two_sided'];
            $file['og_page_size'] = $v['page_size'];
            $file['og_totals'] = $v['totals'];
            $file['og_extra']=$v['extra'];
            $ogdata[] = $file;
        }

        $o_good = new OrderGoods();
        $ogrow = $o_good->saveAll($ogdata);

        //保存订单流程
        $otdata = [
            'ot_o_id'=>$this->o_id,
            'ot_operator' => $userInfo['username'],
            'ot_operate_time' => date("Y-m-d H:i:s"),
            'ot_operate_information' => '您提交了订单，请完成支付',
        ];
        $order_time_line = new OrderTimeline();
        $otrow = $order_time_line->save($otdata);

        if ($orow && $ogrow && $otrow) {
            Db::commit();
            return true;
        } else {
            Db::rollback();
        }

    }

    /**
     * 计算打印文件的费用
     */
    protected function caclPrintFilesFee($files){
        $money = 0;
        foreach ($files as $k => $v) {
            $money += ($v['end_page'] - $v['start_page'] + 1) * $v['totals'] * \think\Config::get('perPageFee');
        }
        return $money;
    }

    //商家订单查询
    public function getBixOrderListByUid($uid, $limit){
        $list = $this
            ->alias("o")
            ->join("biz b", "o.o_b_id = b.b_id", "left")
            ->field("o.*, b.b_username, b.b_name")
            ->where("b.b_id", $uid)
            ->order("o.o_id DESC")
            ->paginate($limit);
        return $list;
    }
    /**
     * 订单查询
     */
    public function getPageListByUid($uid, $limit){
        $list = $this
            ->alias("o")
            ->join("biz b", "o.o_b_id = b.b_id", "left")
            ->field("o.*, b.b_username, b.b_name")
            ->where("o.o_uid", $uid)
            ->order("o.o_id DESC")
            ->paginate($limit);
        return $list;
    }

    /**
     * 根据订单ID获取信息和商户id
     * @param int $id
     * @param int $uid
     */
    public function getOrderInfoByIdAndBid($id, $bid) {
        $row = $this
            ->alias("o")
            ->join("biz b", "o.o_b_id = b.b_id", "left")
            ->field("o.*, b.b_username, b.b_name, b.b_address")
            ->where("o.o_id", $id)
            ->where("b.b_id", $bid)
            ->find();
        return $row;
    }

    /**
     * 根据订单ID获取信息
     * @param int $id
     * @param int $uid
     */
    public function getOrderInfoByIdAndUid($id, $uid) {
        $row = $this
            ->alias("o")
            ->join("biz b", "o.o_b_id = b.b_id", "left")
            ->field("o.*, b.b_username, b.b_name, b.b_address")
            ->where("o.o_id", $id)
            ->where("o.o_uid", $uid)
            ->find();
        return $row;
    }

    /**
     * 完成支付
     * @param \app\user\model\Orders $order
     */
    public function finishOrderPay(Orders $order, User $userinfo) {
        Db::startTrans();
        //用户扣钱
        $uRes = User::where("balance", ">=", $order['o_pay_money'])
            ->where('id',$userinfo['id'])
            ->update([
                'balance' =>  $userinfo['balance'] - $order['o_pay_money']
            ]);

        //订单改为已支付
        $oRes = Orders::where("o_id", $order['o_id'])
            ->update([
                "o_state" => "paid"
            ]);
        //订单时间线加入记录
        $otRes = OrderTimeline::create([
            'ot_o_id' => $order['o_id'],
            'ot_operator' => $userinfo['username'],
            'ot_operate_time' => date("Y-m-d H:i:s"),
            'ot_operate_information' => "已完成支付，等待打印",
        ]);
        if ($uRes && $oRes && $otRes) {
            Db::commit();
            return true;
        } else {
            Db::rollback();
        }
    }

    public function changeOrderState(Orders $order, $username,$state){
        Db::startTrans();
        $msgInfo = NULL;
        switch ($state){
            case'produce':
                $msgInfo = '商家已确认，等待打印';
            break;
            case'delivery':
                $msgInfo = '打印完成,请前往门店领取';
                break;
            default:
                break;
        }
        //订单改为已支付
        $oRes = Orders::where("o_id", $order['o_id'])
            ->update([
                "o_state" => $state
            ]);
        //订单时间线加入记录
        $otRes = OrderTimeline::create([
            'ot_o_id' => $order['o_id'],
            'ot_operator' => $username,
            'ot_operate_time' => date("Y-m-d H:i:s"),
            'ot_operate_information' => $msgInfo,
        ]);
        if ( $oRes && $otRes) {
            Db::commit();
            return true;
        } else {
            Db::rollback();
        }
    }
}