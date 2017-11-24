<?php

namespace backend\controllers;

use backend\models\Upload;
use Yii;
use yii\web\Controller;
use yii\web\UploadedFile;

class UploadController extends Controller {

    public $layout = false;

//    public $enableCsrfValidation = false;

    /**
     * 上传图片
     */
    public function actionImage() {

        $model = new Upload();
        if (Yii::$app->request->isPost) {
            $model->file = UploadedFile::getInstance($model, 'file');
            
            $filename = Yii::$app->security->generateRandomString(32) . "." . $model->file->extension;
            if ($model->validate()) {
                $baseFilePath = "/frontend/web/uploads/" . date("Ymd") . "/";
                $filepath = dirname(dirname(Yii::getAlias('@webroot'))) . $baseFilePath;
                if (!is_dir($filepath)) {
                    mkdir($filepath, '0777', true);
                }

                if (!Yii::$app->request->isSecureConnection) {
                    $baseUrl = "http://" . Yii::$app->request->serverName;
                } else {
                    $baseUrl = "https://" . Yii::$app->request->serverName;
                }
                if (Yii::$app->request->serverPort != '80') {
                    $baseUrl = $baseUrl . ":" . Yii::$app->request->serverPort;
                }

                $model->file->saveAs($filepath . $filename);

                $url = $baseUrl . $baseFilePath . $filename;
                return $this->render('image', [
                            'model' => $model,
                            'url' => $url
                ]);

                /*
                  $http = new \http();
                  $url = "http://www.pc9.la/upload.php";
                  $password = '123456';
                  $time = time();
                  $token = md5($model->file->name . $model->file->extension . $password . $time);
                  $http->upload($url, [
                  //                    'password' => $password
                  'time' => $time,
                  'token' => $token,
                  'name' => $model->file->name,
                  'extenstion' => $model->file->extension
                  ], [
                  'file' => $model->file->tempName
                  ]);
                  $message = $http->data;
                  echo $message;
                 * 
                 */
            }
        }


        return $this->render('image', [
                    'model' => $model
        ]);
    }

    /**
     * 上传文件
     */
    public function actionFile() {
        
    }

    public function actionWebuploader() {

        $model = new Upload();
        if (Yii::$app->request->isPost) {

            //获取yii 上传对象
            $model->file = UploadedFile::getInstanceByName('file');
            //生成文件的名字
            $filename = Yii::$app->security->generateRandomString(32) . "." . $model->file->extension;
            //验证
            if ($model->validate()) {
                //文件保存路径
                $baseFilePath = "/frontend/web/uploads/" . date("Ymd") . "/";
                $filepath = dirname(dirname(Yii::getAlias('@webroot'))) . $baseFilePath;

                if (!is_dir($filepath)) {
                    //创建文件并设置访问权限
                    mkdir($filepath, '0777', true);
                }
                //查看是否是安全请求
                if (!Yii::$app->request->isSecureConnection) {
                    $baseUrl = "http://" . Yii::$app->request->serverName;
                } else {
                    $baseUrl = "https://" . Yii::$app->request->serverName;
                }
                //设置端口
                if (Yii::$app->request->serverPort != '80') {
                    $baseUrl = $baseUrl . ":" . Yii::$app->request->serverPort;
                }

                //从上传对象中,将文件保存到服务器
                $model->file->saveAs($filepath . $filename);

                $url = $baseUrl . $baseFilePath . $filename;
                
                $result = [
                    'stauts' => 2000,
                    'message' => 'Success',
                    'url' => $url
                ];
                Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                //返回json数据
                return $result;
            }
        }
    }

}
