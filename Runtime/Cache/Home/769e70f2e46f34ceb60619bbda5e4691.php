<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title><?php echo ($title); ?></title>
    <link rel="stylesheet" href="/Public/Home/css/index.css">
    
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

    <div class="banner" id="bannerall">
        <ul>
            <?php if(is_array($bannerList)): $i = 0; $__LIST__ = $bannerList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$banner): $mod = ($i % 2 );++$i;?><li>
                    <a href="<?php echo ((isset($banner["url"]) && ($banner["url"] !== ""))?($banner["url"]):'#'); ?>">
                        <!--<div class="banner_list"-->
                             <!--style="background: url('<?php echo get_cover($banner['picture_id'])['path'];?>') center center"></div>-->
                        <div class="banner_list" style="">
                            <img style="width: 100%;" src="<?php echo get_cover($banner['picture_id'])['path'];?>">
                        </div>
                    </a>
                </li><?php endforeach; endif; else: echo "" ;endif; ?>
        </ul>
        <a href="javascript:void(0);" class="unslider-arrow04 prev">
            <div class="up arrow" id="al"></div>
        </a>
        <a href="javascript:void(0);" class="unslider-arrow04 next">
            <div class="next arrow" id="ar"></div>
        </a>
    </div>

    <div class="index_list">
        <div class="index_list1">
            <div class="index_tit">
                WHAT CAN <span class="cl6">WE OFFER?</span>
            </div>
            <div class="index_text1" style="">
                <?php if(is_array($productList)): $i = 0; $__LIST__ = $productList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$product): $mod = ($i % 2 );++$i;?><div class="index_text01" style=" ">
                        <a href="<?php echo ((isset($product["url"]) && ($product["url"] !== ""))?($product["url"]):'#'); ?>">
                            <img class="text-center list_img1" style=""
                                 src="<?php echo get_cover($product['cover_id'])['path'];?>">
                            <img class="text-center list_img2" style="display: none;"
                                 src="<?php echo get_cover($product['hover_cover_id'])['path'];?>">
                            <div class="text_tit" style="">
                                <div><?php echo ($product["title"]); ?></div>
                                <div class="line1" style=""></div>
                            </div>
                        </a>
                        <div>
                            <?php echo ($product["content"]); ?>
                        </div>
                    </div><?php endforeach; endif; else: echo "" ;endif; ?>
            </div>
        </div>

        <div class="index_list2">
            <div class="index_tit">
                WHAT CAN <span class="cl6">YOU DO?</span>
            </div>
            <div class="index_text03" style="">
                <a href="<?php echo ((isset($productIntroduce[0]["url"]) && ($productIntroduce[0]["url"] !== ""))?($productIntroduce[0]["url"]):'#'); ?>">
                    <div class="wid545 text_left "
                         style="background: url('<?php echo get_cover($productIntroduce[0]['cover_id'])['path'];?>')no-repeat; background-position: 0 54px;">
                        <div class="index_bg_img" style="">
                            <div class="index_icon" style=""><?php echo ($productIntroduce[0]["title"]); ?></div>
                        </div>
                    </div>
                </a>
                <div class="wid600 mleft50 ">　
                    <div class="mtop144 text_right">
                        <?php echo ($productIntroduce[0]["content"]); ?>
                    </div>
                    <a href="<?php echo ((isset($productIntroduce[0]["url"]) && ($productIntroduce[0]["url"] !== ""))?($productIntroduce[0]["url"]):'#'); ?>">
                        <div class="see_more">
                            MORE
                            <div class="see_border"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="index_text03" style="">
                <div class="wid600 ">　
                    <div class="mtop144  text_right">
                        <?php echo ($productIntroduce[1]["content"]); ?>
                    </div>
                    <a href="<?php echo ((isset($productIntroduce[1]["url"]) && ($productIntroduce[1]["url"] !== ""))?($productIntroduce[1]["url"]):'#'); ?>">
                        <div class="see_more">
                            MORE
                            <div class="see_border"></div>
                        </div>
                    </a>
                </div>
                <a href="<?php echo ((isset($productIntroduce[1]["url"]) && ($productIntroduce[1]["url"] !== ""))?($productIntroduce[1]["url"]):'#'); ?>">
                    <div class="wid545 mleft50 text_left"
                         style="background: url('<?php echo get_cover($productIntroduce[1]['cover_id'])['path'];?>')no-repeat;background-position: 142px 2px;">
                        <div class="index_bg_img1" style="">
                            <div class="index_icon1" style=""><?php echo ($productIntroduce[1]["title"]); ?></div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="index_list3">
            <video id="player" controls="controls" type='<?php echo ($videoInfo["mime"]); ?>' width="100%" height="100%"
                   src="/Uploads/Download/<?php echo ($videoInfo['savepath']); echo ($videoInfo['savename']); ?>">
            </video>
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

</body>
</html>