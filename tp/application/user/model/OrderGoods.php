<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/18
 * Time: 16:44
 */

namespace app\user\model;


use think\Model;
use traits\model\SoftDelete;

class OrderGoods extends Model {

    //时间戳
    protected $autoWriteTimestamp = 'datetime';
    //软删除
    use SoftDelete;
    protected $deleteTime = 'delete_time';

    protected $name_files = "files";

    /**
     * 根据订单ID获取信息
     * @param type $oid
     */
    public function getInfoByOrderid($oid) {
        $list = $this->table($this->getTable($this->name))
            ->alias("og")
            ->join($this->name_files . " f", "og.og_f_id = f.f_id", "left")
            ->where("og.og_o_id", $oid)
            ->order("og.og_id ASC")
            ->select();

        return $list;
    }
}