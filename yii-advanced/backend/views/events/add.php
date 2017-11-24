<?php

use yii\widgets\LinkPager;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;
use yii\jui\DatePicker;
?>

<script type="text/javascript" src="/admin/js/jquery.min.js"></script>
<!-- //////////////////////////////////////////////////////////////////////////// -->
<script type="text/javascript" src="/admin/layer/layer.js"></script>


<style>
    .upload-thumb {
        cursor: pointer;
    }

</style>
<!-- Start Page Header -->
<div class="page-header">
    <h1 class="title">创建活动</h1>
    <ol class="breadcrumb">
        <li><a href="<?= Url::to(['/index']) ?>">仪表盘</a></li>
        <li><a href="<?= Url::to(['/events']) ?>">活动</a></li>
        <li class="active">创建活动</li>
    </ol>

    <!-- Start Page Header Right Div -->
    <div class="right">
        <div class="btn-group" role="group" aria-label="...">
            <a href="index.html" class="btn btn-light">Dashboard</a>
            <a href="#" class="btn btn-light"><i class="fa fa-refresh"></i></a>
            <a href="#" class="btn btn-light"><i class="fa fa-search"></i></a>
            <a href="#" class="btn btn-light" id="topstats"><i class="fa fa-line-chart"></i></a>
        </div>
    </div>
    <!-- End Page Header Right Div -->

</div>
<!-- End Page Header -->

<!-- //////////////////////////////////////////////////////////////////////////// --> 
<!-- START CONTAINER -->
<div class="container-default">
    <div class="row">
        <div class="col-md-12">
            <?php

            $form = ActiveForm::begin([
                    //表单的id
                        'id' => 'member-profile',
                    //options form表单的属性 <form class='form-horizontal' name='demo'>
                        'options' => ['class' => 'form-horizontal'],
                    //fieldConfig 给form中所有的field设置属性
                        'fieldConfig' => [
                            //template field布局模板
                            'template' => "{label}\n<div class=\"col-md-8\">{input}</div>\n<div class=\"col-lg-12\"><div class=\"col-lg-1 control-label\"></div>{error}</div>",
                            //labeloptions label的html属性
                            'labelOptions' => ['class' => 'col-md-4 control-label'],
                        ],
            ]);
            ?>
            <div class="row">
                <div class="col-md-6">
                    <?= $form->field($model, 'event_name') ?>
                </div>
                <div class="col-md-6">
                    <?=
                    $form->field($model, 'event_thumb', [
                        'template' => "{label}\n<div class=\"col-sm-8\"><div class=\"input-group\"><div type=\"button\" class=\"input-group-addon\">预览</div>{input}<div type=\"button\" class=\"upload-thumb input-group-addon\">浏览</div></div></div>",
                    ])->input('text',['class'=>'form-control','id'=>'event-thumb'])
                    ?>

                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <?= $form->field($model, 'event_type_id')->dropDownList($model->getEventTypes()) ?>
                </div>
                <div class="col-md-6">
<!--                    dropDownList($items,$option)下拉菜单 $items->key真实值 $items->value显示的值-->
                    <?= $form->field($model, 'event_weekday')->dropDownList($model->getWeekDay()) ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <?= Html::label("地区", "", ['class' => 'col-md-4 control-label']); ?>
                        <div class="col-sm-8">
                            <div style="margin-right:-15px">
                                <div class="col-sm-4">
                                    <?=
                                    $form->field($model, 'event_province', [
                                        'template' => "<div class=\"col-sm-12\"><div style=\"margin-left:-15px\">{input}</div></div>"
                                    ])->dropDownList($model->getProvinces(), [
                                        'id' => 'province'
                                    ])->label(false)
                                    ?>
                                </div>
                                <div class="col-sm-4">
                                    <?=
                                    $form->field($model, 'event_city', [
                                        'template' => "<div class=\"col-sm-12\"><div style=\"margin-left:-15px\">{input}</div></div>"
                                    ])->dropDownList(['a' => 100], [
                                        'id' => 'city'
                                    ])->label(false)
                                    ?>
                                </div>
                                <div class="col-sm-4">
                                    <?=
                                    $form->field($model, 'event_district', [
                                        'template' => "<div class=\"col-sm-12\"><div style=\"margin-left:-15px\">{input}</div></div>"
                                    ])->dropDownList(['a' => 100],[
                                        'id' => 'qu'
                                    ])->label(false)
                                    ?>
                                </div>
                            </div>

                        </div>
                    </div>




                </div>
                <div class="col-md-6" style="margin-bottom: 10px;">
                    <label class="col-md-4 control-label">费用类别</label>
                    <div class="col-md-3">
                        <?=
                        $form->field($model, 'event_fee_type_id', [
                            'template' => "<div class=\"col-sm-12\">{input}</div>",
                        ])->dropDownList(['a'=>'费用类型'])
                        ?>
                    </div>
                    <label class="col-md-2 control-label" style="width: 60px;">人均</label>
                    <div class="col-md-3">
                        <?=
                        $form->field($model, 'event_fee_type_id', [
                            'template' => "<div class=\"col-lg-12\">{input}</div>",
                        ]);
                        ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">

                    <?=

                    $form->field($model, 'event_start_time')->widget(DatePicker::className(), ['clientOptions' => [
                        'model' => $model,
                        'attribute' => 'event_start_time',
                        'language' => 'zh-CN',
                        'dateFormat' => 'php:Y-m-d',
                    ]]);
                    ?>
                </div>
                <div class="col-md-6">
                    <?=
                    $form->field($model, 'event_end_time')->widget(DatePicker::className(), ['clientOptions' => [
                        'model' => $model,
                        'attribute' => 'event_end_time',
                        'language' => 'zh-CN',
                        'dateFormat' => 'php:Y-m-d',
                    ]]);
                    ?>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <?= $form->field($model, 'event_headcount') ?>
                </div>
                <div class="col-md-6">
                    <?= $form->field($model, 'event_service_hours') ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <?= $form->field($model, 'event_contact') ?>
                </div>
                <div class="col-md-6">
                    <?= $form->field($model, 'event_contact_phone') ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <?= $form->field($model, 'event_place') ?>
                </div>
                <div class="col-md-6">                
                    <?=
                    $form->field($model, 'event_recruit_type', [

                    ])->inline()->radioList(['yes'=>'团队成员','no'=>'所有志愿者'])
                    ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <?= $form->field($model, 'event_approve')->inline()->radioList(['yes'=>'需要审批','no'=>'不需要审批']) ?>
                </div>
                <div class="col-md-6">
                    <?= $form->field($model, 'event_state')->inline()->radioList(['yes'=>'招募中','no'=>'招募结束']) ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <?=
                    $form->field($model, 'event_recruit_end_time')->widget(DatePicker::className(), ['clientOptions' => [
                        'model' => $model,
                        'attribute' => 'event_recruit_end_time',
                        'language' => 'zh-CN',
                        'dateFormat' => 'php:Y-m-d',
                    ]]);
                    ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <?=
                    $form->field($model, 'event_introduction', [
                        'labelOptions' => ['class' => 'col-md-2 control-label'],
                    ])->textarea()
                    ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <?=
                    $form->field($model, 'event_description', [
                        'labelOptions' => ['class' => 'col-md-2 control-label'],
                    ])->textarea()
                    ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <?=
                    $form->field($model, 'event_condition', [
                        'labelOptions' => ['class' => 'col-md-2 control-label'],
                    ])->textarea()
                    ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <?=
                    $form->field($model, 'event_attention', [
                        'labelOptions' => ['class' => 'col-md-2 control-label'],
                    ])->textarea();
                    ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="col-md-offset-2">
                        <?= Html::submitButton('保存', ['class' => 'btn btn-primary', 'name' => 'event-button']); ?>
                    </div>
                </div>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>



</div>
<!-- END CONTAINER -->


<script type="text/javascript">jQuery(document).ready(function () {
        jQuery('#events-event_start_time').datepicker({"dateFormat":"yy-m-d"});
        jQuery('#events-event_end_time').datepicker({"dateFormat":"yy-m-d"});
        jQuery('#events-event_recruit_end_time').datepicker({"dateFormat":"yy-m-d"});
    });
</script>

<script>
<?php
if (Yii::$app->urlManager->enablePrettyUrl === false) {
    $baseUrl = Url::to(['upload/image']) . "&id=";
} else {
    $baseUrl = Url::to(['upload/image']) . "?id=";
}
?>
    var baseUrl = '<?= $baseUrl ?>';
    $(document).ready(function () {
        $(".upload-thumb").on("click", function () {
            var id = $(this).siblings("input").attr('id');
            layer.open({
                type: 2,
                title: false,
                area: ['630px', '360px'],
                shade: 0.8,
                closeBtn: 0,
                shadeClose: true,
                content: baseUrl + id
            });
        });

        //三级联动
        //绑定下拉选择框的change事件
        $("#province").on("change", function(){
            //获取选中的内容
            var id = $(this).val();
            //获得请求的地址
            var url  = "<?= Url::to(['region/ajaxcities']) ?>";
            //ajax的快速请求方式
            $.getJSON(url, {id: id}, function(data){
                $("#city")[0].options.length = 0;
                for (x in data) {
                    //使用append将得到的新的选项添加到第二个下拉框
                    $("#city").append(new Option(data[x], x));
                }
            })
        })
        $("#city").on("change", function(){
            var id = $(this).val();
            var url  = "<?= Url::to(['region/ajaxcities']) ?>";
            $.getJSON(url, {id: id}, function(data){
                $("#qu")[0].options.length = 0;
                for (x in data) {
                    $("#qu").append(new Option(data[x], x));
                }
            })
        })
    })
</script>

