
<div id="main">
    <div id="position" class="graybg">
        <div class="fl">您的位置：<a href="http://rmb.com" target="_top">首页</a> >> <a href="http://rmb.com/event.html" >活动招募</a> >> 志愿活动</div>
        <form id="searchform" method="get" action="http://rmb.com/search.html">
            <div class="fr search">
                <!--<input name="model" type="radio" value="1" checked/>文章<input name="model" type="radio" value="2"/>活动<input name="model" type="radio" value="3"/>团队-->
                <input name="keyword" type="text" class="txt" value=""/>
                <input class="sbm" type="submit" value="搜索"/>
            </div>
        </form>	</div>
    <div class="col-main" style="margin-top:10px; ">

        <div class="padding10">
            <ul class="sui-nav nav-tabs nav-pills">

                <li class="<?= $type==0?'active':''?>" >
                    <?= \yii\helpers\Html::a('不限分类',['site/events',['type'=>0,'week'=>$week,'status'=>$status]])?>
                </li>
                <?php foreach ($typeModels as $key=>$typeModel):?>
                    <li class="<?= $type==$typeModel->cid?'active':'';?>" >
                        <?= \yii\helpers\Html::a($typeModel->name,['site/events',['type'=>$typeModel->cid,'week'=>$week,'status'=>$status]])?>
                    </li>
                <?php endforeach;?>

            </ul>
            <ul class="sui-nav nav-tabs nav-pills">

                <li class="<?= $week==0?'active':'';?>" ><?= \yii\helpers\Html::a('不限日期',['site/events',['type'=>$type,'week'=>0,'status'=>$status]])?></li>
                <?php foreach ($weekModels as $key=>$weekModel):?>
                    <li class="<?= $week==$weekModel->id?'active':'';?>" >
                        <?= \yii\helpers\Html::a($weekModel->name,['site/events',['type'=>$type,'week'=>$weekModel->id,'status'=>$status]])?>
                    </li>
                <?php endforeach;?>

            </ul>
            <ul class="sui-nav nav-tabs nav-pills">
                <li class="active"><a href="/event/index/id-0-weekday-0-status-0-key-.html">所有状态</a></li>
                <li ><a href="/event/index/id-0-weekday-0-status-1-key-.html">活动招募中</a></li>

                <input name="key" type="text" placeholder="关键字" class="input-medium"  id="key" value="" />
                &nbsp;&nbsp;<button type="button" class="sui-btn" onclick="javascript:gSearch()">搜索</button>
            </ul>
            <script type="text/javascript">function gSearch(){window.location = '/event/index/id-0-weekday-0-status-0-key-'+encodeURI(document.getElementById('key').value)+'.html';}</script>
        </div>

        <div class="m-padding padding10">

            <?php foreach ($eventsModels as $key=>$eventModel):?>
                <table class="layui-table">
                    <tbody>
                    <tr>
                        <td width="150" rowspan="2" align="center">
                            <div class="typographic">
                                <a href="<?= \yii\helpers\Url::to(['site/events',['id'=>$eventModel->id]])?>" title="" target="_blank" class="block-text btn-small"><img src="<?=$eventModel->event_thumb; ?>" title="" alt="<?=$eventModel->event_name; ?>"></a></div>
                        </td>
                        <td colspan="4" class="left">
                            <a href="<?= \yii\helpers\Url::to(['site/events',['id'=>$eventModel->id]])?>" title="查看《 <?=$eventModel->event_name; ?> 》活动介绍" target="_blank" class="block-text btn-small"><h4 style=color:;font-weight:bold;><?=$eventModel->event_name; ?></h4></a>
                        </td>
                    </tr>
                    <tr >
                        <td width="80" class="center"><ul class="unstyled">
                                <li>招募人数：</li>
                                <li>报名人数：</li>
                                <li>服务时数：</li>
                                <li>负 责 人：</li>
                            </ul></td>
                        <td class="left"><ul class="unstyled">
                                <li><?=$eventModel->event_headcount; ?> 人</li>
                                <li>0 人</li>
                                <li><?=$eventModel->event_service_hours; ?>小时</li>
                                <li><?=$eventModel->event_contact; ?></li>
                            </ul></td>
                        <td width="80" class="center"><ul class="unstyled">
                                <li>报名截止：</li>
                                <li>活动时间：</li>
                                <li>活动状态：</li>
                                <li>联络电话：</li>
                            </ul></td>
                        <td class="left"><ul class="unstyled">
                                <li><?=$eventModel->event_recruit_end_time; ?></li>
                                <li><?=$eventModel->event_start_time; ?> 至 <?=$eventModel->event_end_time; ?></li>
                                <li><?= $eventModel->event_state=='yes'?'招募中':'结束招募' ?></li>
                                <li><?=$eventModel->event_contact_phone; ?></li>
                            </ul></td>
                    </tr>
                    </tbody>
                </table>
            <?php endforeach;?>

            <div class="pagination"><ul></ul></div>
        </div>
    </div>
</div>
<div class="claer"></div>
<!--END-->
<!--底部-->
﻿<div style="clear:both"></div>
