<?php

use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;
use yii\helpers\Url;
use backend\assets\AppAsset;

AppAsset::register($this);
?>
<html>
    <?php $this->beginPage() ?>
    <head>
        <?php $this->head() ?>
    </head>
    <body>
    <script type="text/javascript" src="/admin/js/jquery.min.js"></script>

    <link rel="stylesheet" href="/admin/webuploader/webuploader.css"/>
        <link rel="stylesheet" href="/admin/webuploader/uploader-style.css"/>
        <script type="text/javascript" src="/admin/webuploader/webuploader.js"></script>
        <style>
            body {
                background-color: #fff
            }
            .main {
                width: 500px;
                margin: 10px auto;
            }
        </style>
        <?php $this->beginBody() ?>

        <?php if (Yii::$app->request->isPost): ?>
            <script type="text/javascript">
                var id = '<?= Yii::$app->request->get('id') ?>';
                var url = '<?= $url ?>';
                top.window.$("#" + id).val(url);
                top.window.layer.closeAll();
            </script>
        <?php endif; ?>

        <div id="uploader">
            <div class="queueList">
                <div id="dndArea" class="placeholder">
                    <div id="filePicker"></div>
                    <p>或将照片拖到这里，单次最多可选300张</p>
                </div>
            </div>
            <div class="statusBar" style="display:none;">
                <div class="progress">
                    <span class="text">0%</span>
                    <span class="percentage"></span>
                </div><div class="info"></div>
                <div class="btns">
                    <div id="filePicker2"></div><div class="uploadBtn">开始上传</div>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            // 实例化
            var uploader = WebUploader.create({
                pick: {
                    id: '#filePicker',
                    label: '点击选择图片'
                },
                formData: {
                    '<?= Yii::$app->request->csrfParam ?>': '<?= Yii::$app->request->csrfToken ?>'
                },
                dnd: '#dndArea',
                paste: '#uploader',
                swf: '<?= Yii::getAlias('@web') ?>/admin/webuploader/Uploader.swf',
                server: '<?= Url::to(["upload/webuploader"]) ?>',
                // runtimeOrder: 'flash',

                accept: {
                    title: 'Images',
                    extensions: 'gif,jpg,jpeg,bmp,png',
                    mimeTypes: 'image/*'
                },

                // 禁掉全局的拖拽功能。这样不会出现图片拖进页面的时候，把图片打开。
                disableGlobalDnd: true,
                fileNumLimit: 300,
                fileSizeLimit: 200 * 1024 * 1024, // 200 M
                fileSingleSizeLimit: 50 * 1024 * 1024    // 50 M
            });
            uploader.onFileQueued = function (file) {
//                console.log(file);
                uploader.upload();
            }
            uploader.onUploadSuccess = function (file, ret) {
                layer.alert('上传成功, 3秒后关闭！');
                setTimeout(function () {
                    var id = '<?= Yii::$app->request->get('id') ?>';
                    top.window.$("#" + id).val(ret.url);
                    top.window.layer.closeAll();
                }, 3000);

            }
            uploader.on('all', function (type) {
                console.log(type);
            });
        </script>    
    </body>

    <?php $this->endBody() ?>
    <?php $this->endPage() ?>
</html>