/**
 * Created by wangshaohua on 16/9/22.
 */


$(".see_more").hover(function(){
    $(this).find(".see_border").css({
        "border-bottom": "1px solid #41b1ff",
    }).animate({width: "100px"});
},function(){
    $(this).find(".see_border").css({
        "border-bottom": "1px solid #41b1ff",
        "width": "20px",
    });
});
setTimeout($(".index_text01,.index_text02").hover(function(){
        $(this).find(".list_img1").hide();
        $(this).find(".list_img2").show();
        $(this).find(".line1").css({
            "border-top":"1px solid #41b1ff"
         }).animate({width:"100%"},300);
    },function(){
    $(this).find(".list_img2").hide();
    $(this).find(".list_img1").show();
    $(this).find(".line1").css({
        "border-top":"1px solid rgba(255,255,255,0.6)"
    }).animate({width:"60px"},300);
}),1000);
$(".index_text01").last().css("margin-left", "85px");

$(".nav_list_min").find(".nav_list_sm").last().css("border:","none");

/* about */




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

/* about */
/* 首页轮播*/
$(".hezuo_all2,.hezuo_all3").hide();
$(document).ready(function(e) {
    var unslider04 = $('#bannerall').unslider({
            dots: true,
            speed: 600,			   //  切换的速度
            delay: 5000,
            pause:true,				 //鼠标以上去是否暂停播放
            starting:function(){		//每次开始切换时回叫方法
            console.log("complete");
            },

        }),
        data04 = unslider04.data('unslider');
    $('.unslider-arrow04').click(function() {
        var fn = this.className.split(' ')[1];
        data04[fn]();
    });
    $(".dots").hide();
});

/*  悬浮框 */
$(".phone").hover(function(){
    $(".phone_text").show();
},function(){
    $(".phone_text").hide();
})
$(".weixin").hover(function(){
    $(".erweima3").show();
},function(){
    $(".erweima3").hide();
});

$(".qq").hover(function(){
    $(".qq3").show();
},function(){
    $(".qq3").hide();
});


$(".nav_max1").hover(function () {
    $(this).find(".nav_list_min").show();
},function(){
    $(this).find(".nav_list_min").hide();
})



