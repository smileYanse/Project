<div id="main">
    <div id="roll-news" class="graybg" >
        <div id="marquee1" class="wrap">
            <ul>
            </ul>
        </div>
    </div>
</div>
<div id="main">
    <div id="home_oleft">
        <div id="containers" class="containers">
            <div class="image"></div>
            <div class="number"></div>
            <div class="title"></div>
        </div>
        <ul id="slide" style="display:none">
        </ul>
        <script charset="utf-8" language="javascript" type="text/javascript" src="/public/js/picshowset.js"></SCRIPT>
        <script type="text/javascript">
            $('#containers').imgSlide({
                data: 'slide',
                auto: true,
                type: 'mouseover',
                speed: 3000
            });
            function isShow(tab_id,div_id,t_Style,ss)    //
            {
                for(var i = 0;i < 2;i++)
                {
                    document.getElementById("divs_"+i).style.display="none";
                    document.getElementById("tabs_"+i).style.backgroundImage='url(/public/images/bg_taboff.gif)';
                    document.getElementById("tabs_"+i).className="bgoff3";
                }
                document.getElementById(div_id).style.display=t_Style;
                document.getElementById(tab_id).style.backgroundImage='url(/public/images/bg_tabon.gif)';
                document.getElementById(tab_id).className="bgon3";
                document.getElementById('11').innerHTML=ss;
            }
        </script>
    </div>
    <div id="home_ocenter">
        <div class="otitle">
            <span id="11"><a href="http://rmb.com/event.html">更多&gt;&gt;</a></span>
            <span class="bgon3" id="tabs_0" onclick="isShow('tabs_0','divs_0','block','<a href=http://rmb.com/event.html>更多>></a>');" style="cursor: pointer;">活动招募</span>
            <span class="bgoff3" id="tabs_1" onclick="isShow('tabs_1','divs_1','block','<a href=http://rmb.com/vshare.html>更多>></a>');" style="cursor: pointer;">活动分享</span>
        </div>
        <div class="box_i1">
            <ul class="list_1" id="divs_0">
                <li><span>2017-10-27</span><a href="http://rmb.com/event/2.html" target="_top" title="新的活动" class="ellipsis">新的活动</a></li>
            </ul>
            <ul class="list_1" id="divs_1" style="display:none;">
            </ul>
        </div>
        <div class="box_i2"></div>
    </div>
    <div id="home_oright">
        <div id="guanai">
            <ul>
                <form method="post" id="badu" onSubmit="return false;">
                    <div style="width:180px;">
                        <br>
                        <p style="float:left; width:120px">
                            账号：<input name="id" id="id" value="" type="text" maxlength="20" style="width:70px; margin-bottom:2px"/><br>
                            密码：<input name="pd" id="pd" value="" type="password" maxlength="20" style="width:70px; margin-bottom:2px"/></p>
                        <p style="float:right;"><input name="chabtn" type="submit" id="btn_submit" value=" 登录 " style="width:60px; height:50px"></p>

                    </div>
                </form>

                <li><a href="http://rmb.com/member/register.html"></a></li>
                <li><a href="http://rmb.com/member/vtime.html"></a></li>
                <li><a href="http://rmb.com/help/need.html"></a></li>
                <li><a href="http://rmb.com/help/donate.html"></a></li>
            </ul></div>


    </div>
</div>
<div id="main" style="_margin-top:-10px">
    <div class="a">
        <div class="fl a-l">
            <div class="box a-l-1"><div class="top"><h2><span class="fl">工作动态</span><span class="fr" style="font-weight:normal; margin-right:10px;width:60px"><a href="http://rmb.com/dynamics.html">更多&gt;&gt;</a></span></h2></div>
                <div class="mainbody"><div class="column a-l-1-1"><div class="cont">
                            <div class="fl"><ul class="list1">            </ul></div>
                            <div class="fr"><ul></ul></div>
                        </div></div></div>
                <div class="bt"></div></div>
            <div class="box a-l-2"><div class="top">
                    <h2>公益文化</h2></div>
                <div class="mainbody">
                    <div class="column fl"><div class="headline"><h3>公益新闻</h3><a href="http://rmb.com/media.html">更多&gt;&gt;</a></div>
                        <div class="cont"><ul class="list1">
                            </ul></div>
                    </div>
                    <div class="column fr"><div class="headline"><h3>义工分享</h3><a href="http://rmb.com/vshare.html">更多&gt;&gt;</a></div>
                        <div class="cont"><ul class="list1">
                            </ul></div>
                    </div>
                </div>
                <div class="mainbody" style="margin-top:-10px">
                    <div class="column fl"><div class="headline">
                            <h3>义工培训</h3><a href="http://rmb.com/vclass.html">更多&gt;&gt;</a></div>
                        <div class="cont"><ul class="list1">
                            </ul></div>
                    </div>
                    <div class="column fr"><div class="headline">
                            <h3>义工达人</h3><a href="http://rmb.com/vstar.html">更多&gt;&gt;</a></div>
                        <div class="cont"><ul class="list1">
                            </ul></div>
                    </div>
                </div>
                <div class="bt"></div>
            </div>
        </div>
        <div class="fr a-r">
            <div id="blog"><a href="###" target="_top"><img src="/public/images/bbs.gif" alt="更多项目" /></a></div>
            <div class="column a-r-1">
                <div class="headline"><h3>公告通知</h3><a href="http://rmb.com/announce.html">更多&gt;&gt;</a></div>
                <div class="cont"><ul class="list1">
                    </ul></div>
            </div>
            <div class="column a-r-2">
                <div class="headline"><h3>文件资料</h3><ul class="tabs"><li class="curr"><a href="http://rmb.com/download.html">文件库</a></li><li><a href="http://rmb.com/breport.html">财务公示</a></li></ul><a href="http://rmb.com/download.html">更多&gt;&gt;</a></div>
                <div class="cont">
                    <ul class="list1" style="display:block;"></ul>
                    <ul class="list1"></ul>
                </div>
            </div>
            <div class="column a-r-3"></div>
        </div>
    </div>
</div>
<div id="main">
    <div class="box links">
        <div class="top"><h2>友情链接</h2></div>
        <div class="mainbody">
            <a href="http://www.vbadu.com" target='_blank' title="八度印象">八度印象</a>
        </div>
        <div class="bt"></div>
    </div>
</div>
<div class="claer"></div>
<script language="javascript">
    $(function(){
        $('#btn_submit').click(function(){
            if (2>$("#id").val().length) return layer.msg('登录失败,用户名不能少于3位！', {icon: 5});
            if (5>$("#pd").val().length) return layer.msg('登录失败,密码不能少于6位！', {icon: 5});
            $.post("/member/login.html",$('#badu').serialize(),function(data){
                var status=data.status;
                if (status==false){
                    layer.msg('登录失败'+data.message, {icon: 5});
                }else{
                    layer.msg('登录成功！', {icon: 1});
                    location.href = "http://rmb.com";
                };
            },'json');
        });
    });
</script>
﻿<div style="clear:both"></div>
