<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/18
 * Time: 17:14
 */

namespace app\user\controller;
use app\user\controller\UserBase;
use think\Request;

class Prints extends UserBase {
    //提交订单
    public function submitorder(){
        $request = Request::instance();
        $post = $request->post();
        //获取打印店ID
        $bid = $post['bid'];

        $shopids = $post['shopid'];
        //判断shopid数据
        if (empty($shopids)) {
            $this->error("shopid参数错误");
        }
        //要打印的数据
        $files = [];
        foreach ($shopids as $k => $id) {
            $file['fid'] = $k;
            $file['shopid'] = $id;
            $file['start_page'] = $post['start_page'][$k];
            $file['end_page'] = $post['end_page'][$k];
            $file['color'] = $post['color'][$k];
            $file['two_sided'] = $post['two_sided'][$k];
            $file['page_size'] = $post['page_size'][$k];
            $file['totals'] = $post['totals'][$k];
            $file['extra'] = $post['extra'][$k];
            $files[$k] = $file;
        }
        $Orders = new \app\user\model\Orders();
        $row = $Orders->submitOrder($files, $bid, $this->userInfo);
        if ($row) {
            $this->success("创建订单成功，请完成支付", "/user");
        }else {
            $this->error("创建订单失败，请重新发起", "/user/creat_print/");
        }
        die();
    }
}