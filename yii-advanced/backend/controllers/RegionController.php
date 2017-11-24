<?php

namespace backend\controllers;

use Yii;
use backend\models\Region;
use yii\web\Controller;

class RegionController extends Controller {

    /**
     * 获取某个省份的市区列表
     */
    public function actionAjaxcities() {
        $id = (int) Yii::$app->request->get('id');

        $result = [0 => '请选择'];
        
        $model = new Region();
        //通过id获取这个id下的所有子数据
        $row = $model->getListsByParentId($id);
        if (!empty($row)) {
            foreach ($row as $k => $v) {
                $result[$v['id']] = $v['name'];
            }
        }
        //返回数据进行格式化设置--->设置的json
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        //$result就是个json对象
        return $result;
    }

}
