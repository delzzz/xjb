function checkEndTime(startTime,endTime){
    var start=new Date(startTime.replace("-", "/").replace("-", "/"));
    var end=new Date(endTime.replace("-", "/").replace("-", "/"));
    if(end<start){
        return false;
    }
    return true;
}
function dialog(type, title, content) {
    var t = type,
        tit = title,
        cont = content;
    if (t == 0) {
        $("#yes").modal("show");
        $("#yes").find(".title").html(title);
        $("#yes").find(".text").html(content);
    } else if (t == 1) {
        $("#full").modal("show");
        $("#full").find(".title").html(title);
        $("#full").find(".text").html(content);
    }
}

$("form").Validform({
    ajaxPost: true,
    showAllError: true,
    callback: function (data) {
        if (data.status == 1) {
           $('.modal').modal('hide');
            if(data['info']['msg']!='' && data['info']['msg']!=undefined){
                dialog(0,data['info']['msg'],data['info']['msg2'])
            }
            else{
                dialog(0, data.info, '');
            }
            $('#yes,#full').on('hide.bs.modal', function () {
                if(data.url){
                    location.href = data.url;
                }
                else{
                    location.reload();
                }
            });
        } else {
            //updateAlert(data.info);
            dialog(1, data.info, '');
            setTimeout(function () {
                if (data.url) {
                    location.href = data.url;
                } else {
                    $('#top-alert').find('button').click();
                    // $(that).removeClass('disabled').prop('disabled', false);
                }
            }, 500);
        }
    },
    tiptype: function (msg, o, cssctl) {
        //验证错误再显示
        if (o.type == 3) {
            o.obj.siblings('.error').remove();
            o.obj.after("<div class='error color-red Validform_checktip' style='font-size: 12px;'></div>");
            var objtip = o.obj.siblings(".Validform_checktip");
            cssctl(objtip, o.type);
            objtip.text(msg);
        }
    },
    datatype: {//传入自定义datatype类型【方式二】;
        "idcard": function (gets, obj, curform, datatype) {
            var Wi = [7, 9, 10, 5, 8, 4, 2, 1, 6, 3, 7, 9, 10, 5, 8, 4, 2, 1];// 加权因子;
            var ValideCode = [1, 0, 10, 9, 8, 7, 6, 5, 4, 3, 2];// 身份证验证位值，10代表X;
            if (gets.length == 15) {
                return isValidityBrithBy15IdCard(gets);
            } else if (gets.length == 18) {
                var a_idCard = gets.split("");// 得到身份证数组
                if (isValidityBrithBy18IdCard(gets) && isTrueValidateCodeBy18IdCard(a_idCard)) {
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
                for (var i = 0; i < 17; i++) {
                    sum += Wi[i] * a_idCard[i];// 加权求和
                }
                valCodePosition = sum % 11;// 得到验证码所位置
                if (a_idCard[17] == ValideCode[valCodePosition]) {
                    return true;
                }
                return false;
            }

            function isValidityBrithBy18IdCard(idCard18) {
                var year = idCard18.substring(6, 10);
                var month = idCard18.substring(10, 12);
                var day = idCard18.substring(12, 14);
                var temp_date = new Date(year, parseFloat(month) - 1, parseFloat(day));
                // 这里用getFullYear()获取年份，避免千年虫问题
                if (temp_date.getFullYear() != parseFloat(year) || temp_date.getMonth() != parseFloat(month) - 1 || temp_date.getDate() != parseFloat(day)) {
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
        "sel_area": function (gets, obj, curform, datatype) {
            if (gets == 0 || gets == '') {
                if (obj.attr('style').indexOf('display') != -1 && obj.attr('style').indexOf('none') != -1) {
                    obj.next('.error').remove();
                    return true;
                }
                else {
                    return false;
                }
            }
            else {
                obj.next('.error').remove();
                return true;
            }
            return false;
        },
        "sel": function (gets, obj, curform, datatype) {
            if (gets == -1) {
                return false;
            }
            else {
                obj.next('.error').remove();
                return true;
            }
            return false;
        },
        "mb": function (gets, obj, curform, datatype) {
            var myreg = /^(((13[0-9]{1})|(15[0-9]{1})|(18[0-9]{1})|(14[0-9]{1})|(17[0-9]{1}))+\d{8})$/;
            if (!myreg.test(gets)) {
                return false;
            }
            else {
                obj.next('.error').remove();
                return true;
            }
            return false;
        },
        "cpdate":function(gets,obj,curform,datatype){
            var start_date =obj.parents().parents().prev('div').children('div').find('input').val();
            var date1 = new Date(start_date);
            var date2 = new Date(gets);
            if(gets=='年/月/日' || gets==''){
                return false;
            }
            else if(!checkEndTime(start_date,gets)){
                return false;
            }
            else{
                obj.next('.error').remove();
                return true;
            }
            return false;
        },
        "pwdvfy":function(gets,obj,curform,datatype){
            var oldpwd = $.md5(gets);
            if(oldpwd==obj.prev('#oldpwd').val()){
                return true;
            }
            else{
                return false;
            }
            return false;
        }
    }
}).addRule([
    {
        ele: "input:not(input[type='checkbox'],input[type='file'],input[type='hidden'],input[ignore='1'],input[name='targetId']," +
        "input[disabled='disabled'],input[name='age'],input[name='peopleIdentifier'],input[id='basicOrg'],input[name='nativePlace'],input[name='hobbyOtherDesc'])",
        datatype: "*",
        nullmsg: "此项不能为空"
    },
    {
        ele: "input[name='tele_phone']",
        datatype: "mb",
        errormsg: "手机号码格式不正确"
    },
    {
        ele: "input[name='telephone']",
        datatype: "mb",
        errormsg: "手机号码格式不正确"
    },
    {
        ele: "input[name='telephone[]']",
        datatype: "mb",
        errormsg: "手机号码格式不正确"
    },
    {
        ele: "input[name='mobile[]']",
        datatype: "mb",
        errormsg: "手机号码格式不正确"
    },
    {
        ele: "input[name='idNumber']",
        datatype: "idcard",
        errormsg: "身份证号码格式不正确"
    },
    {
        ele: "input[name='idNo[]']",
        datatype: "idcard",
        errormsg: "身份证号码格式不正确"
    },
    {
        ele: "select[name='provinceId'],select[name='cityId'],select[name='countyId']",
        datatype: "sel_area",
        errormsg: "此项为必选项",
    },
    {
        ele: "select[name='dataSrc'],select[name='insType'],select[name='ethnicity'],select[name='education'],select[name='economy'],select[name='livingStatus'],select[name='healthStatus']",
        datatype: "sel",
        errormsg: "此项为必选项",
    },
    {
        ele: "input[name='quantity']",
        datatype: "n",
        errormsg: "请输入数字",
    },
    {
        ele:"input[name='endDate[]']",
        datatype:"cpdate",
        errormsg:"结束服药日期必须大于开始服药日期",
        nullmsg: "此项不能为空"
    },
    {
        ele:"input[name='oldpassword']",
        datatype:"pwdvfy",
        errormsg:"输入密码不正确",
        nullmsg: "此项不能为空"
    }
]);
$("input").focus(function () {
    $(this).next(".error").remove();
});
$(function () {
    $("input[type='text']").each(function () {
        var msgs = $(this).attr('ignore');
        var idName = $(this).attr('id');
        var dsbd = $(this).attr('disabled');
        var name = $(this).attr('name');
        if(msgs!=1 && idName !='key' && dsbd!='disabled' && name!='peopleIdentifier' && name!='nativePlace' && idName!='basicOrg' && name!='hobbyOtherDesc' && name!='age'){
            $(this).parent().css('position','relative');
            $(this).after("<span class='color-red' style='font-size: 20px;position: absolute; right: -4%;top: 10px;'>*</span>")
        }
    });
    $("input[type='password']").each(function () {
            $(this).parent().css('position','relative');
            $(this).after("<span class='color-red' style='font-size: 20px;position: absolute; right: -4%;top: 10px;'>*</span>")
    });
});