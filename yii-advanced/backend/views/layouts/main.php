<?php
use yii\helpers\Html;

use backend\assets\AppAsset;
AppAsset::register($this);  // $this 代表视图对象

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Kode is a Premium Bootstrap Admin Template, It's responsive, clean coded and mobile friendly">
    <meta name="keywords" content="bootstrap, admin, dashboard, flat admin template, responsive," />
    <title>Kode - Premium Bootstrap Admin Template</title>
    <!-- ========== Css Files ========== -->
    <link href="/admin/css/root.css" rel="stylesheet">
    <!-- ================================================
    jQuery Library
    ================================================ -->
    <script type="text/javascript" src="/admin/js/jquery.min.js"></script>
    <?php $this->head() ?>
</head>
<?php $this->beginBody() ?>
<body>
<!-- //////////////////////////////////////////////////////////////////////////// -->
<!-- START TOP -->
<div id="top" class="clearfix">

    <!-- Start App Logo -->
    <div class="applogo">
        <a href='<?= \yii\helpers\Url::to(['site/index'])?>' class="logo">BADU</a>
    </div>
    <!-- End App Logo -->

    <!-- Start Sidebar Show Hide Button -->
    <a href="#" class="sidebar-open-button"><i class="fa fa-bars"></i></a>
    <a href="#" class="sidebar-open-button-mobile"><i class="fa fa-bars"></i></a>
    <!-- End Sidebar Show Hide Button -->


    <!-- Start Top Right -->
    <ul class="top-right">


        <li class="dropdown link">
            <a href="#" data-toggle="dropdown" class="dropdown-toggle profilebox"><img src="/admin/img/profileimg.png" alt="img"><b>
                    <?= Yii::$app->user->identity->username;?>
                </b><span class="caret"></span></a>
            <ul class="dropdown-menu dropdown-menu-list dropdown-menu-right">
                <?= '<li>'
                . Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                    'Logout (' . Yii::$app->user->identity->username . ')',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>' ?>
            </ul>
        </li>

    </ul>
    <!-- End Top Right -->

</div>
<!-- END TOP -->
<!-- //////////////////////////////////////////////////////////////////////////// -->


<!-- //////////////////////////////////////////////////////////////////////////// -->
<!-- START SIDEBAR -->
<div class="sidebar clearfix">

    <ul class="sidebar-panel nav">
        <li class="sidetitle">MAIN</li>

        <li><a href="#"><span class="icon color7"><i class="fa fa-flask"></i></span>活动<span class="caret"></span></a>
            <ul>
                <li><a href="<?= \yii\helpers\Url::to(['events/index'])?>">列表</a></li>
                <li><a href="<?= \yii\helpers\Url::to(['events/add'])?>">新建活动</a></li>
            </ul>
        </li>


        <li><a href="#"><span class="icon color7"><i class="fa fa-flask"></i></span>系统设置<span class="caret"></span></a>
            <ul>
                <li><a href="icons.html">Icons</a></li>

            </ul>
        </li>

    </ul>

    <ul class="sidebar-panel nav">
        <li class="sidetitle">MORE</li>
        <li><a href="grid.html"><span class="icon color15"><i class="fa fa-columns"></i></span>Grid System</a></li>
    </ul>
</div>
<!-- END SIDEBAR -->
<!-- //////////////////////////////////////////////////////////////////////////// -->

<!-- //////////////////////////////////////////////////////////////////////////// -->
<!-- START CONTENT -->
<div class="content">

    <?= $content;?>

    <!-- Start Footer -->
    <div class="row footer">
        <div class="col-md-6 text-left">
            Copyright © 2015 <a href="http://themeforest.net/user/egemem/portfolio" target="_blank">Egemem</a> All rights reserved.
        </div>
        <div class="col-md-6 text-right">
            Design and Developed by <a href="http://themeforest.net/user/egemem/portfolio" target="_blank">Egemem</a>
        </div>
    </div>
    <!-- End Footer -->


</div>
<!-- End Content -->
<!-- //////////////////////////////////////////////////////////////////////////// -->




<!-- ================================================
Bootstrap Core JavaScript File
================================================ -->
<script src="/admin/js/bootstrap/bootstrap.min.js"></script>

<!-- ================================================
Plugin.js - Some Specific JS codes for Plugin Settings
================================================ -->
<script type="text/javascript" src="/admin/js/plugins.js"></script>

<!-- ================================================
Bootstrap Select
================================================ -->
<script type="text/javascript" src="/admin/js/bootstrap-select/bootstrap-select.js"></script>

<!-- ================================================
Bootstrap Toggle
================================================ -->
<script type="text/javascript" src="/admin/js/bootstrap-toggle/bootstrap-toggle.min.js"></script>

<!-- ================================================
Bootstrap WYSIHTML5
================================================ -->
<!-- main file -->
<script type="text/javascript" src="/admin/js/bootstrap-wysihtml5/wysihtml5-0.3.0.min.js"></script>
<!-- bootstrap file -->
<script type="text/javascript" src="/admin/js/bootstrap-wysihtml5/bootstrap-wysihtml5.js"></script>

<!-- ================================================
Summernote
================================================ -->
<script type="text/javascript" src="/admin/js/summernote/summernote.min.js"></script>




<!-- ================================================
Easy Pie Chart
================================================ -->
<!-- main file -->
<script type="text/javascript" src="/admin/js/easypiechart/easypiechart.js"></script>
<!-- demo codes -->
<script type="text/javascript" src="/admin/js/easypiechart/easypiechart-plugin.js"></script>

<!-- ================================================
Sparkline
================================================ -->
<!-- main file -->
<script type="text/javascript" src="/admin/js/sparkline/sparkline.js"></script>
<!-- demo codes -->
<script type="text/javascript" src="/admin/js/sparkline/sparkline-plugin.js"></script>


<!-- ================================================
Data Tables
================================================ -->
<script src="/admin/js/datatables/datatables.min.js"></script>

<!-- ================================================
Sweet Alert
================================================ -->
<script src="/admin/js/sweet-alert/sweet-alert.min.js"></script>

<!-- ================================================
Kode Alert
================================================ -->
<script src="/admin/js/kode-alert/main.js"></script>


<!-- ================================================
jQuery UI
================================================ -->
<script type="text/javascript" src="/admin/js/jquery-ui/jquery-ui.min.js"></script>

<!-- ================================================
Moment.js
================================================ -->
<script type="text/javascript" src="/admin/js/moment/moment.min.js"></script>

<!-- ================================================
Full Calendar
================================================ -->
<script type="text/javascript" src="/admin/js/full-calendar/fullcalendar.js"></script>

<!-- ================================================
Bootstrap Date Range Picker
================================================ -->
<script type="text/javascript" src="/admin/js/date-range-picker/daterangepicker.js"></script>


</body>
<?php $this->endBody() ?>
</html>

<?php $this->beginPage() ?>