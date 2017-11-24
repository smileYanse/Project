<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/18
 * Time: 16:43
 */

namespace app\user\model;


use think\Model;
use traits\model\SoftDelete;
class OrderTimeline extends Model {
    //时间戳
    protected $autoWriteTimestamp = 'datetime';
    //软删除
    use SoftDelete;
    protected $deleteTime = 'delete_time';
}