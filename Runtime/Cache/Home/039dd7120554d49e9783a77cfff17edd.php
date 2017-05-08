<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title><?php echo ($title); ?></title>
    <link rel="stylesheet" href="/Public/Home/css/index.css">
    
    <link rel="stylesheet" href="/Public/Home/css/about.css">

</head>

<body>
<div class="top" id="top">
    <div class="top_text ">
        <div class="logo " style="">
            <img src="/Public/Home/images/index/logo.png">
        </div>
        <div class="new_nav" style="">
            <div class="nav_max" style="">
                <a href="<?php echo U('Index/index');?>">
                    <div class="nav_list1">首页</div>
                </a>
            </div>
            <div class="nav_max1" style="">
                <div class="nav_lists">
                    <!--<a href="<?php echo U('Product/index');?>">-->
                        <div class="nav_list1" style="">产品介绍</div>
                    <!--</a>-->
                </div>
                <!--二级菜单-->
                <div class="nav_list_min" style="">
                    <?php if(is_array($navProductList)): $i = 0; $__LIST__ = $navProductList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i;?><a href="<?php echo U('Product/index?name='.$list['name']);?>">
                            <div class="nav_list_sm" style=""><?php echo ($list["title"]); ?></div>
                        </a><?php endforeach; endif; else: echo "" ;endif; ?>
                </div>
            </div>
            <div class="nav_max1" style="">
                <div class="nav_lists">
                    <a href="<?php echo U('Solution/index');?>">
                        <div class="nav_list1" style="">解决方案</div>
                    </a>
                </div>
                <div class="nav_list_min" style="">
                    <?php if(is_array($navSoulationList)): $i = 0; $__LIST__ = $navSoulationList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$s): $mod = ($i % 2 );++$i;?><a href="<?php echo U('Solution/index?name='.$s['name']);?>">
                            <div class="nav_list_sm" style=""><?php echo ($s["title"]); ?></div>
                        </a><?php endforeach; endif; else: echo "" ;endif; ?>
                </div>
            </div>
            <div class="nav_max1" style="">
                <a href="<?php echo U('Partner/index');?>">
                    <div class="nav_list1" style="">合作共赢</div>
                </a>
            </div>
            <div class="nav_max1" style="">
                <a href="<?php echo U('About/index');?>">
                    <div class="nav_list1" style="">关于我们</div>
                </a>
            </div>
            <div class="nav_max1" style="">
                <a href="<?php echo U('Adverties/index');?>">
                    <div class="nav_list1" style="">招贤纳士</div>
                </a>
            </div>
        </div>
        <div class="nav" style="margin-top: 20px; z-index: 30000; position: relative;">
        </div>
    </div>
</div>

    <div class="about">
        <div class="about_text">
            <!--公司简介 富文本-->
            <div class="jianjie">
                <?php echo ($aboutUs["content"]); ?>
            </div>
            <div class="fintus">
                <div class="fintus_tit">
                    联系我们
                </div>
                <div class="fintus_tit1 mtop20">
                    <?php echo C('CONTACT_US_AD');?>
                </div>
                <div class="lian" style="">
                    <div class="lian_left" style="">
                        <div class="lian_tit mtop40" style=""><?php echo C('COMPANNY_NAME');?></div>
                        <div class="mtop5 ft16">
                            <span class="cl4">地址：</span>
                            <span class=""><?php echo C('COMPANNY_ADDRESS');?></span>
                        </div>
                        <div class="lian_tit mtop20" style="">品牌与战略合作</div>
                        <div class="mtop5 ft16">
                            <span class="cl4">联系人：</span>
                            <span class=""><?php echo C('PARTNER_PERSON');?></span>
                        </div>
                        <div class="mtop5 ft16">
                            <span class="cl4">手机：</span>
                            <span class=""><?php echo C('PARTNER_PERSON_MOBILE');?></span>
                        </div>

                        <div class="lian_tit mtop20" style="">产品与销售合作</div>
                        <div class="mtop5 ft16">
                            <span class="cl4">联系人：</span>
                            <span class=""><?php echo C('PRODUCT_PERSON');?></span>
                        </div>
                        <div class="mtop5 ft16">
                            <span class="cl4">手机：</span>
                            <span class=""><?php echo C('PRODUCT_PERSON_MOBILE');?></span>
                        </div>

                    </div>
                    <form class="lian_right" style="">
                        <div class="lian_tit mtop20 " style="">
                            <span class="cl4">/留言咨询</span><span class="ft14">(为保证咨询质量，请认真填写，稍后我们将会有专人和您联系)</span>
                        </div>
                        <div class="liuyan_list ft16 mtop5">
                            <span class="cl4">姓&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;名：</span>
                            <input type="text" name="name" class="input" placeholder="某先生">
                        </div>
                        <div class="liuyan_list ft16 mtop5">
                            <span class="cl4">性&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;别：</span>
                            <input type="radio" name="sex" value="1" class="radio mleft30"/><span class="mleft8">先生</span>
                            <input type="radio" name="sex" value="0" checked="checked" class="radio mleft30"/><span class="mleft8">女士</span>
                        </div>
                        <div class="liuyan_list ft16 mtop5">
                            <span class="cl4">电&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;话：</span>
                            <input type="text" name="phone" class="input" placeholder="">
                        </div>
                        <div class="liuyan_list ft16 mtop5">
                            <span class="cl4">地&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;址：</span>
                            <input type="text" name="city" class="input2" placeholder=""><span
                                class="mleft8">省</span>
                            <input type="text" name="smcity" class="input2 mleft8" placeholder=""><span
                                class="mleft8">市</span>
                        </div>

                        <div class="liuyan_list h100 ft16 mtop20">
                            <div class="cl4">留言咨询：</div>
                             <textarea name="message" class="text_box"></textarea>
                        </div>
                        <div class="liuyan_list ft16 mtop20">
                            <button type="button" class="about_btn">提交</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>


    </div>


    <div class="foot">
        <div class="foot_text">
            <div class="callus_tit" style="">
                联系我们
            </div>
            <div class="callus_txt">
                地址：<?php echo ($contact["address"]); ?>
            </div>
            <div class="callus_txt">
                电话：<?php echo ($contact["tel"]); ?>
            </div>
            <div class="callus_txt">
                手机：<?php echo ($contact["tel"]); ?>
            </div>
            <div class="callus_txt">
                联系人：<?php echo ($contact["contact_person"]); ?>
            </div>

            <div class="erweima1" style="">
                <img width="121" height="121" src="/Public/Home/images/xservice.jpg">
                <div class="mtop20 ">
                    官方微信公众号
                </div>
            </div>
            <div class="erweima2" style="">
                <img width="121" height="121" src="/Public/Home/images/xdy.jpg">
                <div class="mtop20 ">
                    星途科技
                </div>
            </div>
        </div>
    </div>
    <div class="xfk">
        <div class="wh58 qq"></div>
        <div class="wh58 weixin">
            <div class="erweima3">
                <div class="weixin_text" style="padding: 1px;">
                    <img style="" src="/Public/Home/images/dingyue.jpg">

                    <div style="line-height: 100%;margin-top: 5px;">扫描关注微信公众号</div>
                </div>
            </div>
        </div>
        <div class="wh58 phone">
            <div class="phone_text" style="">
                客服热线<br/>
                400 036 1945
            </div>
        </div>
        <a href="#top">
            <div class="wh58 gotop"></div>
        </a>
    </div>
    <div class="footer">
        <div class="footer_text">
            <span style="">沪ICP备14023054号</span>
            <!--<span class="flt_r" style="">官方微信公众号：星途科技</span>-->
        </div>
    </div>

<script src="/Public/Home/js/jquery-1.9.1.min.js"></script>
<script src="/Public/Home/js/star_vr.js"></script>
<script src="/Public/Home/js/unslider.min.js"></script>
<script type="text/javascript">
    var currentNav = "<?php echo U();?>";
    $('.new_nav').find('a').find('div').removeClass('tachs');
    $('.new_nav').find("a[href='" + currentNav + "']").find('div').addClass('tachs');

    $(".phone").hover(function () {
        $(".phone_text").show();
    }, function () {
        $(".phone_text").hide();
    });
    $(".weixin").hover(function () {
        $(".erweima3").show();
    }, function () {
        $(".erweima3").hide();
    });
</script>

    <script src="/Public/Home/js/unslider.min.js"></script>
    <script>
        $(document).ready(function () {
            $(".about_btn").click(function () {
                $(this).attr('disabled',true);
                var phoneObj=$("input[name='phone']");
                var nameObj=$("input[name='name']");
                var textboxObj=$(".text_box");
                if(nameObj.val()==''||nameObj==null){
                    nameObj.val('姓名不能为空').css("color","red");
                    nameObj.focus(function(){
                        test(nameObj)
                    });
                    return false;
                }
                if(phoneObj.val()==''||phoneObj.val()==null)
                {
                    phoneObj.val('手机号不能为空').css("color","red");
                    phoneObj.focus(function(){
                        test(phoneObj)
                    });
                    return false;
                }
                if(textboxObj.val()==''||textboxObj.val()==null){
                    textboxObj.val('资讯信息不能为空').css("color","red");
                    textboxObj.focus(function(){
                        test(textboxObj)
                    });
                    return false;
                }
                var param = $('.lian_right').serialize();
                $.ajax({
                    type:'POST',
                    url:'<?php echo U('write');?>',
                    dataType:'json',
                    data:param,
                    success:function (data) {
                        console.log(data);
                        if(data.status){
                            alert("留言成功");
                            location.href="<?php echo U();;?>";
                        }else {
                            alert("留言失败");
                        }
                    }
                });
            });
            var unslider04 = $('#bannerall').unslider({
                        dots: true
                    }),
                    data04 = unslider04.data('unslider');
            $('.unslider-arrow04').click(function () {
                var fn = this.className.split(' ')[1];
                data04[fn]();
            });
        });
        function test(a){
            $(a).val('').css("color","#333333").one();
        }
        function input(){
            var phoneObj=$("input[name='phone']");
            var nameObj=$("input[name='name']");
            var textboxObj=$(".text_box");
            if(nameObj.val()==''||nameObj==null){
                nameObj.val('姓名不能为空').css("color","red");
                nameObj.focus(function(){
                    test(nameObj)
                });
                return false;
            }
            if(phoneObj.val()==''||phoneObj.val()==null)
            {
                phoneObj.val('手机号不能为空').css("color","red");
                phoneObj.focus(function(){
                    test(phoneObj)
                });
                return false;
            }
            if(textboxObj.val()==''||textboxObj.val()==null){
                textboxObj.val('资讯信息不能为空').css("color","red");
                textboxObj.focus(function(){
                    test(textboxObj)
                });
                return false;
            }

        }
    </script>


</body>
</html>