<div id="main">
    <div id="position" class="graybg">
        <div class="fl">您的位置：<a href="http://rmb.com" target="_top">首页</a> >> <a href="http://rmb.com/event.html" >活动招募</a> >> </div>
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
            <fieldset class="layui-elem-field layui-field-title">
                <legend><h3 style=color:;font-weight:bold;><?=$eventsModel->event_name; ?></h3></legend>
            </fieldset>
            <table class="layui-table sui-table">
                <tbody>
                <tr>
                    <td width="80">招募对象：</td>
                    <td class="left"><font color="#006600">所有人</font></td>
                    <td width="80" class="center">报名审核：</td>
                    <td class="left"><font color="#FF0000">需要审核通过才能参加活动</font></td>
                </tr>
                <tr>
                    <td>招募人数：</td>
                    <td class="left"><?=$eventsModel->event_headcount; ?> 人</td>
                    <td class="center">活动费用：</td>
                    <td class="left">免费</td>
                </tr>
                <tr>
                    <td>报名人数：</td>
                    <td class="left">0 人</td>
                    <td class="center">报名截止：</td>
                    <td class="left"><?=$eventsModel->event_recruit_end_time; ?></td>
                </tr>
                <tr>
                    <td>服务时数：</td>
                    <td class="left"><?=$eventsModel->event_service_hours; ?> 小时</td>
                    <td class="center">所在区域：</td>
                    <td class="left"><?=$eventsModel->event_area; ?></td>
                </tr>
                <tr>
                    <td>负 责 人：</td>
                    <td class="left"><?=$eventsModel->event_contact; ?></td>
                    <td class="center">活动时间：</td>
                    <td class="left"><?=$eventsModel->event_start_time; ?> 至 <?=$eventsModel->event_end_time; ?></td>
                </tr>
                <tr>
                    <td>联络电话：</td>
                    <td class="left"><?=$eventsModel->event_contact_phone; ?></td>
                    <td class="center">集合地点：</td>
                    <td class="left"><?=$eventsModel->event_place; ?></td>
                </tr>
                </tbody>
            </table>
            <div class="layui-tab layui-tab-brief" lay-filter="docDemoTabBrief">
                <ul class="layui-tab-title">
                    <li class="layui-this">【 活 动 说 明 】</li>
                    <li>【 注 意 事 项 】</li>
                    <li>【 报 名 条 件 】</li>
                    <li>【 报 名 申 请 】</li>
                    <li>【 通 过 名 单 】</li>
                    <li>【 待审批或未通过名单 】</li>
                </ul>
                <div class="layui-tab-content">
                    <div class="layui-tab-item layui-show"><img src="/upload/2017-11/02/0d5d6eeb2f84b5a781bac8d015917b3b.jpg" title="1505382410266" alt="1505382410266" /></div>
                    <div class="layui-tab-item"></div>
                    <div class="layui-tab-item"></div>
                    <div class="layui-tab-item">
                        <form class="layui-form" id="badu" onSubmit="return false;">
                            <input type="hidden" name="<?= Yii::$app->request->csrfParam ?>" value="<?= Yii::$app->request->csrfToken ?>">
                            <div class="layui-form-item">
                                <label class="layui-form-label">会员编号：</label>
                                <div class="layui-input-inline">
                                    <input id="vcard" name="vcard" type="text" value="<?= $v_card?>" class="layui-input" required lay-verify="required" placeholder="请输入会员编号" readonly="readonly" /></div></div><div class="layui-form-item"><label class="layui-form-label">手机号码：</label><div class="layui-input-inline">
                                    <input id="mobile" name="mobile" type="text" value="" class="layui-input" required lay-verify="required" placeholder="请输入联系电话" /></div></div>                 <div class="layui-form-item">
                                <div class="layui-input-block">
                                    <input type="hidden" value="<?= $eventsModel->id?>" name="eid">
                                    <button class="layui-btn" lay-submit="" lay-filter="btn_submit" id="btn_submit">提交报名</button>
                                    <button type="reset" class="layui-btn layui-btn-primary">重置</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="layui-tab-item">

                    </div>
                    <div class="layui-tab-item">

                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<div class="claer"></div>
<script>
    layui.use(['form','element'], function(){
        var form = layui.form();
        var $ = layui.jquery,element = layui.element();
        //监听提交
        form.on('submit(formDemo)', function(data){
            layer.msg(JSON.stringify(data.field));
            return false;
        });
    });
</script>
<script language="javascript">
    $(function(){
        $('#btn_submit').click(function(){
            $.post("/site/bao-ming",$('#badu').serialize(),function(data){
                var status=data.status;
                if (status==false){
                    layer.msg('操作失败！ '+data.message, {icon: 5});
                }else{
                    layer.msg(data.message, {icon: 1,time: 2000}, function(){
                        //location.href = '/site/index';
                    });
                };
            },'json');
        });
    });
</script>
<!--END-->
<!--底部-->
﻿<div style="clear:both"></div>
