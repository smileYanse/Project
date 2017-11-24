<?php
use yii\helpers\Html;
?>
<!DOCTYPE HTML>
<html>
<head>

    <?= Html::csrfMetaTags() ?>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>义工协会 - 八度义工协会</title>
    <meta name="keywords" content="八度义工协会" />
    <meta name="description" content="八度义工协会" />
    <link type="text/css" rel="stylesheet" href="/public/layui/css/layui.css">
    <link type="text/css" rel="stylesheet" href="/public/css/style.css?1509521169" />
    <script src="/public/js/jquery.v1.7.2.js"></script>
    <script type="text/javascript" src="/public/layui/layui.js"></script>
    <script type="text/javascript" src="/public/layer/layer.js"></script>
    <script src="/public/js/time.js?ver=1"></script>
    <script language="javascript">
        function AddFavorite(sURL, sTitle)
        {
            try
            {
                window.external.addFavorite(sURL, sTitle);
            }
            catch (e)
            {
                try
                {
                    window.sidebar.addPanel(sTitle, sURL, "");
                }
                catch (e)
                {
                    alert("加入收藏失败，有劳您手动添加。");
                }
            }
        }
    </script>
    <script language="JavaScript" type="text/JavaScript">
        function f_check_ZhOrNumOrLett(obj){    //判断是否是汉字、字母、数字组成
            if(checkFormTxtItem(obj)==false)
            {
                alert("请输入关键词！");
            }
            else{
                var regu = "^[0-9a-zA-Z\u4e00-\u9fa5]+$";
                var re = new RegExp(regu);
                if (re.test( obj.value )) {
                    document.form1.submit();
                } else{
                    alert("只能输入汉字、字母或数字！");
                    //return false;
                }
            }
        }
        function checkFormTxtItem(objT){//text不能为空
            if(AllTrim(objT.value) == "") return false;
            else return true;
        }

        function AllTrim(str){
            if(str.charAt(0) == " "){
                str = str.slice(1);
                str = AllTrim(str);
            }
            return str;
        }
    </script>

    <script charset="utf-8" language="javascript" type="text/javascript" src="/public/js/picshow.js"></SCRIPT>
    <script src="/public/js/marquee.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(function(){
            $('#marquee1').Marquee({isEqual:false,scrollDelay:30});
            $('#marquee2').Marquee({direction:'up',isEqual:false,scrollDelay:40});
        });
    </script>
    <style type="text/css">
        #tupic {background: #FFF;overflow:hidden;width: 920px;overflow:hidden;margin-left:-10px;margin-right:15px}
        #tupic img {width:150px;height:100px}
        #intupic {float: left;width: 800%;}
        #tupic1 {float: left;}
        #tupic2 {float: left;}
    </style>

</head>
<body>
<!--头部-->
<div id="header">
    <div id="toolbar">
        <div class="wrap">
            <ul>
                <li class="slogan">秉持志愿精神，以传播志愿文化为使命！</li>
                <li class="date"><script language="javascript">showTime()</script></li>
                <li class="home"><a href="http://rmb.com/">首页</a></li>
                <li class="collect"><a href="#" onclick="AddFavorite('http://rmb.com','义工协会');return false;">加入收藏</a></li>
                <li class="sethome"><a href="http://rmb.com/member/register.html">义工申请</a></li>
                <li class="sitemap nobor"><a href="http://rmb.com/member.html">会员中心</a></li>
            </ul>
        </div>
    </div>
    <div id="header-main" class="w950">
        <div class="fl" style="margin-top:8px;"><h1 id="logo"><a href="http://rmb.com/">义工协会</a></h1></div>
        <div class="fr" style="margin-top:12px;_margin-top:14px;width:480px">
            <ul id="nav">
                <li><a href="<?= \yii\helpers\Url::to(['index']) ?>">网站首页</a></li>
                <li><a href="http://rmb.com/news.html">协会新闻</a></li>
                <li><a href="<?= \yii\helpers\Url::to(['site/events']) ?>">活动招募</a></li>
                <li><a href="http://rmb.com/help.html">互助中心</a></li>
                <li><a href="http://rmb.com/eshare.html">活动分享</a></li>
                <li><a href="http://rmb.com/vshare.html">义工分享</a></li>
                <li><a href="http://rmb.com/media.html">公益新闻</a></li>
                <li><a href="http://rmb.com/policy.html">政策法规</a></li>
                <li><a href="http://rmb.com/breport.html">财务公开</a></li>
                <li><a href="http://rmb.com/vstar.html">义工达人</a></li>
                <li><a href="http://rmb.com/vclass.html">义工培训</a></li>
                <li><a href="http://rmb.com/download.html">文件下载</a></li>
            </ul>
        </div>
    </div>
</div><!--主体-->
<?= $content;?>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" style="margin-top:10px" summary="1">
    <tr>
        <td bgcolor="#E1E1E1" height="5px"></td>
    </tr>
    <tr>
        <td height="25" align="center" bgcolor="#F6F6F6" >
            <a href="/">网站首页</a> | <a href="aboutus.html" title="关于我们" target='_blank'>关于我们</a>
            | <a href="baselaw.html" title="协会章程" target='_blank'>协会章程</a>
            | <a href="structure.html" title="组织架构" target='_blank'>组织架构</a>
            | <a href="contact.html" title="联系我们" target='_blank'>联系我们</a>
        </td>
    </tr>
    <tr>
        <td height="60px" align="center" bgcolor="#F6F6F6">
            <p>
                版权所有 <span style="font-family:Tahoma;">&copy; </span>八度义工协会
            </p><p class="support">技术支持：<a href="http://vbadu.com" target="_blank">上饶市八度印象科技有限公司</a></p>
            <div style="display:none"></div>
        </td>
    </tr>
</table>
</body>
</html>