<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title><?php echo ($title); ?></title>
    <link rel="stylesheet" href="/Public/Home/css/index.css">
    
    <link rel="stylesheet" href="/Public/Home/css/product.css">
    <style>
        .product img{
            width: 100%;
            opacity: 0;
        }
    </style>

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
                    <!--<a href="<?php echo U('Solution/index');?>">-->
                    <div class="nav_list1" style="">解决方案</div>
                    <!--</a>-->
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

    <div class="product" style="background: url('<?php echo get_cover($solution['cover_id'])['path'];?>')no-repeat center; background-size: 100% 100%;">
        <img  src="<?php echo get_cover($solution['cover_id'])['path'];?>">
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
                手机：<?php echo ($contact["mobile"]); ?>
            </div>
            <div class="callus_txt">
                联系人：<?php echo ($contact["contact_person"]); ?>
            </div>

            <div class="erweima1" style="">
                <img width="121" height="121" src="/Public/Home/images/xdy.jpg">
                <div class="mtop20 ">
                    官方微信公众号
                </div>
            </div>
            <div class="erweima2" style="">
                <img width="121" height="121" src="/Public/Home/images/weibo.png">
                <div class="mtop20 ">
                    官方微博
                </div>
            </div>
        </div>
    </div>
    <div class="xfk">
        <div class="wh58 qq">
            <div class="qq3">
                <div class="weixin_text" style="padding: 1px;">
                    <img style="" src="/Public/Home/images/qq.png">
                </div>
            </div>
        </div>
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

var _hmt = _hmt || [];
(function() {
  var hm = document.createElement("script");
  hm.src = "https://hm.baidu.com/hm.js?96a4cb67733b5a72f896a83d13d383f9";
  var s = document.getElementsByTagName("script")[0]; 
  s.parentNode.insertBefore(hm, s);
})();


</script>

    <script src="/Public/Home/js/unslider.min.js"></script>
    <script>
        $(document).ready(function (e) {
            var unslider04 = $('#bannerall').unslider({
                        dots: true
                    }),
                    data04 = unslider04.data('unslider');
            $('.unslider-arrow04').click(function () {
                var fn = this.className.split(' ')[1];
                data04[fn]();
            });
        });
    </script>

</body>
</html>