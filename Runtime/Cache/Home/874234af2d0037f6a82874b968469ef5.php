<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title><?php echo ($title); ?></title>
    <link rel="stylesheet" href="/Public/Home/css/index.css">
    
    <link rel="stylesheet" href="/Public/Home/css/jquery.fullPage.css">
    <link rel="stylesheet" href="/Public/Home/css/product_list.css">

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

    <div id="dowebok">
        <?php if(is_array($productPicture)): $i = 0; $__LIST__ = $productPicture;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i;?><div class="section" style="">
                <img src="<?php echo ($list["path"]); ?>">
            </div><?php endforeach; endif; else: echo "" ;endif; ?>
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

    <script src="/Public/Home/js/jquery.easing.min.js"></script>
    <script src="/Public/Home/js/jquery.fullPage.min.js"></script>
    <script>
        $(function () {
            $('#dowebok').fullpage({
                navigation: true,
                paddingTop: '120px'
            });
        });

    </script>

</body>
</html>