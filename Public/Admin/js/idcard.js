/**
 * Created by wangshaohua on 2017/6/12.
 */
$("form").Validform({
    tiptype: function (msg, o, cssctl) {
        var objtip = $("input[name='tele_phone'],input[name='telephone']");
        cssctl(objtip, o.type);
        o.obj.after("<div class='error color-red' style='font-size: 12px;'>" + msg + "</div>");
    }
}).addRule([
    {
        ele: "input[name='tele_phone']",
        datatype: "m",
        nullmsg: "请输入手机号码！",
        errormsg: "手机号码格式不正确"
    }, {
        ele: "input[name='telephone']",
        datatype: "m",
        nullmsg: "请输入手机号码！",
        errormsg: "手机号码格式不正确"
    }, {
        ele: "input[name='mobile[]']",
        datatype: "m",
        nullmsg: "请输入手机号码！",
        errormsg: "手机号码格式不正确"
    }
]);

function IdentityCodeValid(code, obj) {
    $(".errro").remove();
    var city = {
        11: "北京",
        12: "天津",
        13: "河北",
        14: "山西",
        15: "内蒙古",
        21: "辽宁",
        22: "吉林",
        23: "黑龙江 ",
        31: "上海",
        32: "江苏",
        33: "浙江",
        34: "安徽",
        35: "福建",
        36: "江西",
        37: "山东",
        41: "河南",
        42: "湖北 ",
        43: "湖南",
        44: "广东",
        45: "广西",
        46: "海南",
        50: "重庆",
        51: "四川",
        52: "贵州",
        53: "云南",
        54: "西藏 ",
        61: "陕西",
        62: "甘肃",
        63: "青海",
        64: "宁夏",
        65: "新疆",
        71: "台湾",
        81: "香港",
        82: "澳门",
        91: "国外 "
    };
    var tip = "";
    var pass = true;

    if (!code || !/^\d{6}(18|19|20)?\d{2}(0[1-9]|1[12])(0[1-9]|[12]\d|3[01])\d{3}(\d|X)$/i.test(code)) {
        tip = "身份证号格式错误";
        pass = false;
    }

    else if (!city[code.substr(0, 2)]) {
        tip = "地址编码错误";
        pass = false;
    }
    else {
        //18位身份证需要验证最后一位校验位
        if (code.length == 18) {
            code = code.split('');
            //∑(ai×Wi)(mod 11)
            //加权因子
            var factor = [7, 9, 10, 5, 8, 4, 2, 1, 6, 3, 7, 9, 10, 5, 8, 4, 2];
            //校验位
            var parity = [1, 0, 'X', 9, 8, 7, 6, 5, 4, 3, 2];
            var sum = 0;
            var ai = 0;
            var wi = 0;
            for (var i = 0; i < 17; i++) {
                ai = code[i];
                wi = factor[i];
                sum += ai * wi;
            }
            var last = parity[sum % 11];
            if (parity[sum % 11] != code[17]) {
                tip = "校验位错误";
                pass = false;
            }
        }
    }
    if (!pass) {
        // alert(pass);
        obj.parent("div").append("<div class='color-red error' style='font-size: 12px;'>" + tip + "</div>");
    }

    return pass;
}
//    var c = '130981199312253466';
//    var res= IdentityCodeValid(c);


function IdCard(UUserCard, num) {
    if (num == 1) {
        //获取出生日期
        var birth = UUserCard.substring(6, 10) + "-" + UUserCard.substring(10, 12) + "-" + UUserCard.substring(12, 14);
        return birth;
    }
    if (num == 2) {
        //获取性别
        if (parseInt(UUserCard.substr(16, 1)) % 2 == 1) {
            //男
            return "男";
        } else if (parseInt(UUserCard.substr(16, 1)) % 2 == 0) {
            //女
            return "女";
        }
    }
    if (num == 3) {
        //获取年龄
        var myDate = new Date();
        var month = myDate.getMonth() + 1;
        var day = myDate.getDate();
        var age = myDate.getFullYear() - UUserCard.substring(6, 10) - 1;
        if (UUserCard.substring(10, 12) < month || UUserCard.substring(10, 12) == month && UUserCard.substring(12, 14) <= day) {
            age++;
        }
        return age;
    }
}

$("input").focus(function () {
    $(this).next(".error").remove();
})
$("input[name='idNumber'],input[name='idNo[]']").blur(function () {
    var obj = $(this);
    $(this).next(".error").remove();
    var val = $(this).val();
    var num = IdentityCodeValid(val, obj);
    if (num) {
        // alert(IdCard(val, 1) + IdCard(val, 2) + IdCard(val, 3));
    }
});
//验证方法入口
function vilad() {
    var result = true;
    //验证身份证
    $("input").each(function (i, item) {
        // console.log(item);
        var name = $(this).attr("name");
        var val = $(this).val();

        if (name == "idNumber" || name == "idNo[]") {
            var obj = $(this).eq(i);
            result = IdentityCodeValid(val, obj);
            if (!result) {
                $(this).next("span").remove();
                $(this).parent().append("<span class='color-red error' style='font-size: 12px'>" + name + "身份证格式错误</span>")
            }
        }
        if (name != null && name != undefined) {
            var inputs_type = $(this).attr('type');
            var msgs = $(this).attr('ignore');
            if (val == '' && msgs != 1 && inputs_type!='hidden') {
                $(this).next("span").remove();
                $(this).parent().append("<span class='color-red error' style='font-size: 12px'>" + name + "此项为必填项</span>")
                result = false;
            }
        }
    });
    $("select").each(function () {
        var sel_name = $(this).attr("name");
        var msgs = $(this).attr('ignore');
        var sel_val = $(this).val();
        if (sel_name != null && sel_name != undefined && msgs != 1) {
            if (sel_val == -1 || sel_val == null) {
                $(this).next("span").remove();
                $(this).parent().append("<span class='color-red error'style='font-size: 12px'>" + sel_name + "此项为必选项</span>")
                result = false;
            }
        }
    });
    return result;
}

$("input").blur(function () {
    if ($(this).val() == '') {
        $(this).next(".error").remove();
        $(this).parent().append("<span class='color-red error' style='font-size: 12px'>此项为必填项</span>");
    }
    //
    // }
});

$("input").focus(function () {
    $(this).next(".error").remove();
});
//$("button[type='button']").click(function () {
//    vilad();
//    $("form").Validform();
//});
// 表单非空校验
