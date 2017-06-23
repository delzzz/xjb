/**
 * Created by wangshaohua on 2017/6/12.
 */
//var res=0;
$("form").Validform({
    ignore:"hidden",
    ajaxPost:true,
    showAllError:true,
    beforeSubmit:function(curform){
        if ($(this).hasClass('confirm')) {
            if (!confirm('确认要执行该操作吗?')) {
                return false;
            }
        }
    },
    callback:function(data){
        console.log(data);
        if (data.status == 1) {
            if (data.url) {
                alert(data.info);
                //updateAlert(data.info + ' 页面即将自动跳转~', 'alert-success');
            } else {
                alert(data.info);
                //updateAlert(data.info, 'alert-success');
            }
            setTimeout(function () {
                    location.reload();
            }, 1500);
        } else {
            //updateAlert(data.info);
            alert(data.info);
            setTimeout(function () {
                if (data.url) {
                    location.href = data.url;
                } else {
                    $('#top-alert').find('button').click();
                    $(that).removeClass('disabled').prop('disabled', false);
                }
            }, 1500);
        }
    },
    tiptype: function (msg, o, cssctl) {
        if(o.type!=2){
            o.obj.next('.error').remove();
            o.obj.after("<div class='error color-red Validform_checktip' style='font-size: 12px;'></div>");
            var objtip = o.obj.siblings(".Validform_checktip");
            cssctl(objtip, o.type);
            objtip.text(msg);
        }
    },
    datatype:{//传入自定义datatype类型【方式二】;
        "idcard":function(gets,obj,curform,datatype){
            var Wi = [ 7, 9, 10, 5, 8, 4, 2, 1, 6, 3, 7, 9, 10, 5, 8, 4, 2, 1 ];// 加权因子;
            var ValideCode = [ 1, 0, 10, 9, 8, 7, 6, 5, 4, 3, 2 ];// 身份证验证位值，10代表X;
            if (gets.length == 15) {
                return isValidityBrithBy15IdCard(gets);
            }else if (gets.length == 18){
                var a_idCard = gets.split("");// 得到身份证数组
                if (isValidityBrithBy18IdCard(gets)&&isTrueValidateCodeBy18IdCard(a_idCard)) {
                    return true;
                }
                return false;
            }
            return false;
            function isTrueValidateCodeBy18IdCard(a_idCard) {
                var sum = 0; // 声明加权求和变量
                if (a_idCard[17].toLowerCase() == 'x') {
                    a_idCard[17] = 10;// 将最后位为x的验证码替换为10方便后续操作
                }
                for ( var i = 0; i < 17; i++) {
                    sum += Wi[i] * a_idCard[i];// 加权求和
                }
                valCodePosition = sum % 11;// 得到验证码所位置
                if (a_idCard[17] == ValideCode[valCodePosition]) {
                    return true;
                }
                return false;
            }

            function isValidityBrithBy18IdCard(idCard18){
                var year = idCard18.substring(6,10);
                var month = idCard18.substring(10,12);
                var day = idCard18.substring(12,14);
                var temp_date = new Date(year,parseFloat(month)-1,parseFloat(day));
                // 这里用getFullYear()获取年份，避免千年虫问题
                if(temp_date.getFullYear()!=parseFloat(year) || temp_date.getMonth()!=parseFloat(month)-1 || temp_date.getDate()!=parseFloat(day)){
                    return false;
                }
                return true;
            }
            function isValidityBrithBy15IdCard(idCard15) {
                var year = idCard15.substring(6, 8);
                var month = idCard15.substring(8, 10);
                var day = idCard15.substring(10, 12);
                var temp_date = new Date(year, parseFloat(month) - 1, parseFloat(day));
                // 对于老身份证中的你年龄则不需考虑千年虫问题而使用getYear()方法
                if (temp_date.getYear() != parseFloat(year) || temp_date.getMonth() != parseFloat(month) - 1 || temp_date.getDate() != parseFloat(day)) {
                    return false;
                }
                return true;
            }
        },
        "sel_area":function(gets,obj,curform,datatype){
                if(gets==0 || gets==''){
                    if(obj.attr('style').indexOf('display')!=-1 && obj.attr('style').indexOf('none')!=-1){
                        return true;
                    }
                    else{
                        return false;
                    }
                }
                else{
                    return true;
                }
            return false;
        },
        "sel":function(gets,obj,curform,datatype){
            if(gets==-1){
                return false;
            }
            else{
                return true;
            }
            return false;
        }
    }
}).addRule([
    {
        ele: "input:not(input[type='checkbox'],input[type='hidden'],input[ignore='1'])",
        datatype:"*",
        nullmsg: "此项不能为空"
    },
    {
        ele: "input[name='tele_phone']",
        datatype: "m",
        errormsg: "手机号码格式不正确"
    },
    {
        ele: "input[name='telephone']",
        datatype: "m",
        errormsg: "手机号码格式不正确"
    },
    {
        ele: "input[name='mobile[]']",
        datatype: "m",
        errormsg: "手机号码格式不正确"
    },
    {
        ele:"input[name='idNumber']",
        datatype:"idcard",
        errormsg:"身份证号码格式不正确"
    },
    {
        ele:"input[name='idNo[]']",
        datatype:"idcard",
        errormsg:"身份证号码格式不正确"
    },
    // {
    //     ele:"select:not(select:hidden)",
    //     datatype:"*",
    //     nullmsg:"此项为必选项",
    //     errormsg:"此项为必选项"
    // }
    {
        ele:"select[name='provinceId'],select[name='cityId'],select[name='countyId']",
        datatype:"sel_area",
        errormsg:"此项为必选项",
    },
    {
        ele:"select[name='dataSrc']",
        datatype:"sel",
        errormsg:"此项为必选项",
    }
    // {
    //     ele:"select:not(select[ignore='1'],select[name='dataSleepValue'],select[name='dataSrc'])",
    //     datatype:"sel_area",
    //     nullmsg:"此项为必选项",
    //     errormsg:"此项为必选项",
    //     sucmsg:""
    // }

])

// function IdentityCodeValid(code, obj) {
//     var city = {
//         11: "北京",
//         12: "天津",
//         13: "河北",
//         14: "山西",
//         15: "内蒙古",
//         21: "辽宁",
//         22: "吉林",
//         23: "黑龙江 ",
//         31: "上海",
//         32: "江苏",
//         33: "浙江",
//         34: "安徽",
//         35: "福建",
//         36: "江西",
//         37: "山东",
//         41: "河南",
//         42: "湖北 ",
//         43: "湖南",
//         44: "广东",
//         45: "广西",
//         46: "海南",
//         50: "重庆",
//         51: "四川",
//         52: "贵州",
//         53: "云南",
//         54: "西藏 ",
//         61: "陕西",
//         62: "甘肃",
//         63: "青海",
//         64: "宁夏",
//         65: "新疆",
//         71: "台湾",
//         81: "香港",
//         82: "澳门",
//         91: "国外 "
//     };
//     var tip = "";
//     var pass = '';
//
//     if (!code || !/^\d{6}(18|19|20)?\d{2}(0[1-9]|1[12])(0[1-9]|[12]\d|3[01])\d{3}(\d|X)$/i.test(code)) {
//         //tip = "身份证号格式错误";
//         pass += 1;
//     }
//
//     else if (!city[code.substr(0, 2)]) {
//         //tip = "身份证号格式错误";
//         pass += 2;
//     }
//     else {
//         //18位身份证需要验证最后一位校验位
//         if (code.length == 18) {
//             code = code.split('');
//             //∑(ai×Wi)(mod 11)
//             //加权因子
//             var factor = [7, 9, 10, 5, 8, 4, 2, 1, 6, 3, 7, 9, 10, 5, 8, 4, 2];
//             //校验位
//             var parity = [1, 0, 'X', 9, 8, 7, 6, 5, 4, 3, 2];
//             var sum = 0;
//             var ai = 0;
//             var wi = 0;
//             for (var i = 0; i < 17; i++) {
//                 ai = code[i];
//                 wi = factor[i];
//                 sum += ai * wi;
//             }
//             var last = parity[sum % 11];
//             if (parity[sum % 11] != code[17]) {
//                 //tip = "身份证号格式错误";
//                 pass += 3;
//             }
//         }
//     }
//     console.log(pass);
//     if (pass!='') {
//        // obj.parent("div").append("<div class='color-red error' style='font-size: 12px;'>" + tip + "</div>");
//         return false;
//     }
//     else{
//         return true;
//     }
//}
//    var c = '130981199312253466';
//    var res= IdentityCodeValid(c);


// function IdCard(UUserCard, num) {
//     if (num == 1) {
//         //获取出生日期
//         var birth = UUserCard.substring(6, 10) + "-" + UUserCard.substring(10, 12) + "-" + UUserCard.substring(12, 14);
//         return birth;
//     }
//     if (num == 2) {
//         //获取性别
//         if (parseInt(UUserCard.substr(16, 1)) % 2 == 1) {
//             //男
//             return "男";
//         } else if (parseInt(UUserCard.substr(16, 1)) % 2 == 0) {
//             //女
//             return "女";
//         }
//     }
//     if (num == 3) {
//         //获取年龄
//         var myDate = new Date();
//         var month = myDate.getMonth() + 1;
//         var day = myDate.getDate();
//         var age = myDate.getFullYear() - UUserCard.substring(6, 10) - 1;
//         if (UUserCard.substring(10, 12) < month || UUserCard.substring(10, 12) == month && UUserCard.substring(12, 14) <= day) {
//             age++;
//         }
//         return age;
//     }
// }

$("input").focus(function () {
    $(this).next(".error").remove();
});
// $("input[name='idNumber'],input[name='idNo[]']").blur(function () {
//     var obj = $(this);
//     $(this).next(".error").remove();
//     var val = $(this).val();
//     var pass = IdentityCodeValid(val, obj);
    //return pass;
    //if (num) {
        // alert(IdCard(val, 1) + IdCard(val, 2) + IdCard(val, 3));
    //}
//});
//验证方法入口
// function vilad(target_form) {
//     var result = '';
    //验证身份证
    // if(!$("input[name='idNumber'],input[name='idNo[]']").blur()){
    //     result += 4;
    // }
    // $("."+target_form+" input").each(function (i, item) {
    //     // console.log(item);
    //     var name = $(this).attr("name");
    //     var val = $(this).val();

        // if (name != null && name != undefined) {
        //     var inputs_type = $(this).attr('type');
        //     var msgs = $(this).attr('ignore');
        //     if (val == '' && msgs != 1 && inputs_type!='hidden') {
        //         $(this).next("span").remove();
        //         $(this).parent().append("<span class='color-red error' style='font-size: 12px'>此项为必填项</span>");
        //         result += 5;
        //     }
        // }

        // if (name == "idNumber" || name == "idNo[]") {
        //     var obj = $(this).eq(i);
        //     result = IdentityCodeValid(val, obj);
        //     if (!result) {
        //         $(this).next(".error").remove();
        //         $(this).parent().append("<span class='color-red error' style='font-size: 12px'>身份证格式错误</span>");
        //         result += 4;
        //     }
        // }

 //   });

   //  console.log(result);
   // return false;
   //  if(result!=''){
   //      return false;
   //  }
   //  else{
   //      return true;
   //  }
//}

// $("input").blur(function () {
//     var msgs = $(this).attr('ignore');
//     if ($(this).val() == '' && msgs != 1) {
//         $(this).next(".error").remove();
//         $(this).parent().append("<span class='color-red error' style='font-size: 12px'>此项为必填项</span>");
//     }
// });
//
// $("select").change(function () {
//     $(this).next(".error").remove();
//     var msgs = $(this).attr('ignore');
//     if ($(this).val() == '' && msgs != 1) {
//         $(this).parent().append("<span class='color-red error Validform_wrong' style='font-size: 12px'>此项为必填项</span>");
//     }
// });




