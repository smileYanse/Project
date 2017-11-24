<?php

use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;
use yii\widgets\ListView;
use yii\data\ActiveDataProvider;
use yii\grid\GridView;

//数据获取器,配合小部件使用的
$dataProvider = new ActiveDataProvider([
    'query' => \backend\models\Events::find(),
    'pagination' => [
        'pageSize' => 2,
    ],
        ]);
?>
<!-- Start Page Header -->
<div class="page-header">
    <h1 class="title">活动列表</h1>
    <ol class="breadcrumb">
        <li><a href="index.html">面板</a></li>
        <li><a href="#">活动</a></li>
        <li class="active">列表</li>
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
        <div class="col-sm-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <?php
                    echo GridView::widget([

                        //没有数据的文本显示
                        'emptyText'=>'当前没有活动',
                        //空文本的配置
                        'emptyTextOptions'=>['style'=>'color:red;font-weight:bold'],
                        //整体的布局
                        //'layout'=>"{summary}\n{items}\n{pager}",
                        //空的时候不显示表格
                        //'showOnEmpty'=>false,
                        //数据提供者
                        'dataProvider' => $dataProvider,
//                        'filterModel' => new \backend\models\EventsSearchModel(),
                        //列的配置
                        'columns' => [
                            //CheckboxColumn 复选列
                            //RadioButtonColumn 单选列
                            //SerialColumn 序号列
                            [
                                'class' => 'yii\grid\SerialColumn',
                                'header'=>'序号',
                            ],
                            // 数据提供者中所含数据所定义的简单的列
                            // 使用的是模型的列的数据
                            'id',
                            'event_name',
                            'event_headcount',
                            [
                                //列要显示的属性
                                'attribute'=>'event_state',
                                //属性的值的自定义处理
                                'value'=>function($data){
                                    if ($data->event_state=='yes'){
                                        return '招募中';
                                    }else{
                                        return '停止招募';
                                    }
                                },
                                //label对表头进行定制
                                //'label'=>'aaa'
                            ],
                            [
                                'attribute'=>'event_area',
                                //value:自定义属性的值
                                'value'=>function($data){
                                    //$data一整条的数据
                                    $data = explode(',',$data->event_area);
                                    $str = '';
                                    foreach ($data as $key=>$id){
                                        $r = \backend\models\Region::getInfoById($id);
                                        $str .= $r->name;
                                    }
                                    return $str;
                                }
                            ],
                            [
                                'attribute'=>'event_type_id',
                                //value:自定义属性的值
                                'value'=>function($data){
                                    //$data一整条的数据
                                     $type = $data->event_type_id;
                                    $type_model = \backend\models\Category::findOne(['cid'=>$type]);
                                    return $type_model->name;
                                }
                            ],
                            [
                                //特使的列
                                'class' => 'yii\grid\ActionColumn',
                                //模板布局
                                'template' => '<span>{change}</span><span>{view}</span><span>{delete}</span>',
                                //对模板布局的具体实现
                                'buttons' => [
                                    //view模板布局里面的占位
                                    //闭包->view真实的显示结果
                                    'view' => function ($url, $model, $key) {
                                        //url 当前动作的地址
                                        //model 当前行的model数据
                                        //key 当前行的model的id
                                        return Html::a('显示', ['view', 'id' => $key], ['class' => 'btn btn-sm btn-info']);
                                    },
                                    'delete' => function ($url, $model, $key) {

                                        return Html::a('删除', ['delete', 'id' => $key], ['class' => 'btn btn-sm btn-primary']);
                                    },
                                    'change' => function ($url, $model, $key) {
                                        return Html::a('改变', ['change', 'id' => $key], ['class' => 'btn btn-sm btn-info']);
                                    }
                                ],
                                'options' => [
                                    'width' => 200
                                ]
                            ],

                        ]
                    ]);
                    ?>

                </div>
            </div>

        </div>
    </div>
</div>
<!-- END CONTAINER -->
<!-- //////////////////////////////////////////////////////////////////////////// --> 
