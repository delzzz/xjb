<?php
// +----------------------------------------------------------------------
// | OneThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.onethink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: 麦当苗儿 <zuojiazi@vip.qq.com> <http://www.thinkphp.cn>
// +----------------------------------------------------------------------

define('HOST', '192.168.1.244:8080');
/**
 * 前台配置文件
 * 所有除开系统级别的前台配置
 */
return array(
    /*页面显示条数*/
    'PAGE_SIZE' => '15',
    /* 数据缓存设置 */
    'DATA_CACHE_PREFIX' => 'onethink_', // 缓存前缀
    'DATA_CACHE_TYPE' => 'File', // 数据缓存类型
    'URL_MODEL' => 2,
    'BANNER_TYPE' => 'banner',
    'PRODUCT_TYPE' => 'product_introduce',
    /* 文件上传相关配置 */
    'DOWNLOAD_UPLOAD' => array(
        'mimes' => '', //允许上传的文件MiMe类型
        'maxSize' => 200 * 1024 * 1024, //上传的文件大小限制 (0-不做限制)
        'exts' => 'jpg,gif,png,jpeg,zip,rar,tar,gz,7z,doc,docx,txt,xml,mp4,avi,3gp,rmvb,wmv,mkv,mpg,vob,mov,flv', //允许上传的文件后缀
        'autoSub' => true, //自动子目录保存文件
        'subName' => array('date', 'Y-m-d'), //子目录创建方式，[0]-函数名，[1]-参数，多个参数使用数组
        'rootPath' => './Uploads/Download/', //保存根路径
        'savePath' => '', //保存路径
        'saveName' => array('uniqid', ''), //上传文件命名规则，[0]-函数名，[1]-参数，多个参数使用数组
        'saveExt' => '', //文件保存后缀，空则使用原后缀
        'replace' => false, //存在同名是否覆盖
        'hash' => true, //是否生成hash编码
        'callback' => false, //检测文件是否存在回调函数，如果存在返回文件信息数组
    ), //下载模型上传配置（文件上传类配置）

    /* 图片上传相关配置 */
    'PICTURE_UPLOAD' => array(
        'mimes' => '', //允许上传的文件MiMe类型
        'maxSize' => 200 * 1024 * 1024, //上传的文件大小限制 (0-不做限制)
        'exts' => 'jpg,gif,png,jpeg', //允许上传的文件后缀
        'autoSub' => true, //自动子目录保存文件
        'subName' => array('date', 'Y-m-d'), //子目录创建方式，[0]-函数名，[1]-参数，多个参数使用数组
        'rootPath' => './Uploads/Picture/', //保存根路径
        'savePath' => '', //保存路径
        'saveName' => array('uniqid', ''), //上传文件命名规则，[0]-函数名，[1]-参数，多个参数使用数组
        'saveExt' => '', //文件保存后缀，空则使用原后缀
        'replace' => false, //存在同名是否覆盖
        'hash' => true, //是否生成hash编码
        'callback' => false, //检测文件是否存在回调函数，如果存在返回文件信息数组
    ), //图片上传相关配置（文件上传类配置）

    'PICTURE_UPLOAD_DRIVER' => 'Qiniu',
    //本地上传文件驱动配置
    'UPLOAD_LOCAL_CONFIG' => array(),
    'UPLOAD_BCS_CONFIG' => array(
        'AccessKey' => '',
        'SecretKey' => '',
        'bucket' => '',
        'rename' => false
    ),
    'UPLOAD_QINIU_CONFIG' => array(
        'accessKey' => 'bdwqwF5SJiIKUeQKt5eDJ_1KKcdiDtrX0BCqV-j0',
        'secrectKey' => 'fE1sY3EcK81b0fDyQB1YgKgVwRdUZ1lp2uPF3wiP',
        'bucket' => 'csyl',
        'domain' => 'opqbvrdj2.bkt.clouddn.com',
        'timeout' => 3600,
    ),


    /* 编辑器图片上传相关配置 */
    'EDITOR_UPLOAD' => array(
        'mimes' => '', //允许上传的文件MiMe类型
        'maxSize' => 2 * 1024 * 1024, //上传的文件大小限制 (0-不做限制)
        'exts' => 'jpg,gif,png,jpeg', //允许上传的文件后缀
        'autoSub' => true, //自动子目录保存文件
        'subName' => array('date', 'Y-m-d'), //子目录创建方式，[0]-函数名，[1]-参数，多个参数使用数组
        'rootPath' => './Uploads/Editor/', //保存根路径
        'savePath' => '', //保存路径
        'saveName' => array('uniqid', ''), //上传文件命名规则，[0]-函数名，[1]-参数，多个参数使用数组
        'saveExt' => '', //文件保存后缀，空则使用原后缀
        'replace' => false, //存在同名是否覆盖
        'hash' => true, //是否生成hash编码
        'callback' => false, //检测文件是否存在回调函数，如果存在返回文件信息数组
    ),

    /* 模板相关配置 */
    'TMPL_PARSE_STRING' => array(
        '__STATIC__' => __ROOT__ . '/Public/static',
        '__ADDONS__' => __ROOT__ . '/Public/' . MODULE_NAME . '/Addons',
        '__IMG__' => __ROOT__ . '/Public/' . MODULE_NAME . '/images',
        '__CSS__' => __ROOT__ . '/Public/' . MODULE_NAME . '/css',
        '__JS__' => __ROOT__ . '/Public/' . MODULE_NAME . '/js',
        '__VENDOR__' => __ROOT__ . '/Public/' . MODULE_NAME . '/vendors',
        '__SRC__' => __ROOT__ . '/Public/' . MODULE_NAME . '/src',
        '__BUILD__' => __ROOT__ . '/Public/' . MODULE_NAME . '/build',
    ),

    /* SESSION 和 COOKIE 配置 */
    'SESSION_PREFIX' => 'onethink_admin', //session前缀
    'COOKIE_PREFIX' => 'onethink_admin_', // Cookie前缀 避免冲突
    'VAR_SESSION_ID' => 'session_id',    //修复uploadify插件无法传递session_id的bug

    /* 后台错误页面模板 */
    'TMPL_ACTION_ERROR' => MODULE_PATH . 'View/Public/error.html', // 默认错误跳转对应的模板文件
    'TMPL_ACTION_SUCCESS' => MODULE_PATH . 'View/Public/success.html', // 默认成功跳转对应的模板文件
    'TMPL_EXCEPTION_FILE' => MODULE_PATH . 'View/Public/exception.html',// 异常页面的模板文件

    /*机构性质*/
    'INS_TYPE' => [
        '0' => '医疗机构', '1' => '生活小区', '2' => '养老机构', '3' => '家庭／个人', '4' => '注册公司'
    ],
    /*学历*/
    'EDUCATION' => [
        '不识字',
        '小学',
        '初中',
        '高中/中专',
        '专科',
        '本科',
        '研究生及以上'
    ],
    /*经济来源*/
    'ECONOMY' => [
        '城镇职工基本养老保险',
        '城市低保',
        '子女供养',
        '家庭存款',
        '离退休金',
        '五保',
        '抚恤金',
        '商业保险',
        '其他',
    ],
    /*居住情况*/
    'LIVINGSTATUS' => [
        '一人居',
        '二老居',
        '一人保姆居',
        '二老保姆居',
        '子女同居',
        '孙辈同居',
        '其他',
    ],
    /*健康状况*/
    'HEALTHSTATUS' => [
        '健康',
        '基本健康',
        '不健康但能自理',
        '生活不能自理',
    ],

    'HOBBY' => [
        ['name' => '歌舞'],
        ['name' => '下棋'],
        ['name' => '书法'],
        ['name' => '乐器'],
        ['name' => '晨练'],
        ['name' => '逛公园']
    ],
    /*民族*/
    'ETHNICITY' => [
        '汉族',
        '蒙古族',
        '回族',
        '藏族',
        '维吾尔族',
        '苗族',
        '彝族',
        '壮族',
        '布依族',
        '朝鲜族',
        '满族',
        '侗族',
        '瑶族',
        '白族',
        '土家族',
        '哈尼族',
        '哈萨克族',
        '傣族',
        '黎族',
        '僳僳族',
        '佤族',
        '畲族',
        '高山族',
        '拉祜族',
        '水族',
        '东乡族',
        '纳西族',
        '景颇族',
        '柯尔克孜族',
        '土族',
        '达斡尔族',
        '仫佬族',
        '羌族',
        '布朗族',
        '撒拉族',
        '毛南族',
        '仡佬族',
        '锡伯族',
        '阿昌族',
        '普米族',
        '塔吉克族',
        '怒族',
        '乌孜别克族',
        '俄罗斯族',
        '鄂温克族',
        '德昂族',
        '保安族',
        '裕固族',
        '京族',
        '塔塔尔族',
        '独龙族',
        '鄂伦春族',
        '赫哲族',
        '门巴族',
        '珞巴族',
        '基诺族',
    ],

    /*医疗保险类型*/
    'MEDICAL_INSURANCE' =>
        [
            '城镇职工医疗保险',
            '城镇居民医疗保险',
            '新型农村合作医疗',
            '商业保险',
            '其它'
        ],
    /*血型*/
    'BLOOD_TYPE' =>
        [
            'A型',
            'B型',
            'AB型',
            'O型'
        ],
    /*数据来源*/
    'DATASRC' => [
        '数据导入',
        '手工录入',
        '体检报告',
        '家庭端导入'
    ],

    /*睡眠质量*/
    'DATASLEEPVALUE' => [
        '优',
        '良',
        '差',
    ],
    /*历史报警分类*/
    'WARNING_STATUS' => [
        '查看全部报警分类',
        '紧急呼叫',
        '人体红外监测',
        '门磁状态监测',
        '烟雾报警',
        '燃气泄漏报警',
        '漏水监测',
    ],

    /*血糖测量时间*/
    'MEASURE_CONDITION' => [
        '餐前',
        '餐后'
    ],

    /*报警处理类型*/
    'PROCESS_MODE' =>
        [
            '主动与老人链接视频',
            '坐席帮助老人添加医疗机构第三方视频',
            '拨打亲属电话',
        ],
    /*报警处理结果*/
    'PROCESS_RESULT' =>
        [
            '成功',
            '失败'
        ],
    /*报警处理类型*/
    'PROCESS_RESULT_TYPE' =>
        [
            ['name' => '已经通知当地医疗结构 '],
            ['name' => '已经通知亲属、本人'],
            ['name' => '误触发'],
            ['name' => '设备损坏'],
            ['name' => '其它']
        ],
    /*报警类型*/
    'ALARM_TYPE' =>
        [
            'SOS紧急警报',
            '呼叫报警',
            '呼吸急促',
            '呼吸缓慢',
            '心率过快',
            '心率缓慢'
        ],

    'DEVICE_TYPE' => [
        '老人终端机',
        'SOS手腕',
        '门磁状态检测仪',
        '烟雾报警器',
        '漏水检测器',
        '呼吸心率仪',
        '人体红外加测'
    ],


    'ORG_CONDITION' => [
        ['name' => '医护人员'],
        ['name' => '急救设施'],
        ['name' => '拥有坐席']
    ],
    'DOSE_UNIT' => [
        '粒',
        '片',
        '袋',
        '颗',
        '瓶'
    ],

    /*接口配置*/
    'INTERFACR_API' => array(

        'agent_create' => 'http://' . HOST . '/service/org/agent/create',//创建代理商
        'agent_update' => 'http://' . HOST . '/service/org/agent/update',//更新代理商
        'get_agent_detail' => 'http://' . HOST . '/service/org/agent/detail/',//获取代理商详情
        'get_agent' => 'http://' . HOST . '/service/org/agent/',//根据代理商ID获取代理商详情
        'agent_collocation' => 'http://' . HOST . '/service/org/agent/collocation/create',//代理商托管
        'get_org_agent' => 'http://' . HOST . '/service/org/agent/get',//获取代理商
        'query_agent' => 'http://' . HOST . '/service/org/agent/query',//查询代理商
        'is_collocation' => 'http://' . HOST . '/service/org/agent/collocation/isCollocation',//查询代理商是否托管
        'target_collocation' => 'http://' . HOST . '/service/org/agent/collocation/queryTarget',//查询被托管代理商
        'source_collocation' => 'http://' . HOST . '/service/org/agent/collocation/querySource',//查询托管代理商
        'confirm_collocation' => 'http://' . HOST . '/service/org/agent/collocation/confirm',//确认托管
        'update_collocation' => 'http://' . HOST . '/service/org/agent/collocation/update',//重新托管
        'cancel_collocation' => 'http://' . HOST . '/service/org/agent/collocation/cancel',//取消托管
        'agent_statistics'=>'http://' . HOST . '/service/statistics/org/agent/',//代理商统计

        'ins_create' => 'http://' . HOST . '/service/org/ins/create', //创建机构
        'ins_update' => 'http://' . HOST . '/service/org/ins/update',//更新机构
        'ins_collocation' => 'http://' . HOST . '/service/org/ins/collocation',//机构托管
        'query_org' => 'http://' . HOST . '/service/org/ins/query',//查询机构
        'get_org_detail' => 'http://' . HOST . '/service/org/ins/detail/', //获取机构详情
        'get_org_ins' => 'http://' . HOST . '/service/org/ins/get', //根据objectid获取机构详情


        'get_user' => 'http://' . HOST . '/service/user/get', //获取系统用户信息
        'user_update'=>'http://' . HOST . '/service/user/update',//变更用户信息
        'user_update_password'=>'http://' . HOST . '/service/user/update/password',//变更用户信息

        'del_pic' => 'http://' . HOST . '/service/image/delete/',//删除图片

        'zuoxi_detail' => 'http://' . HOST . '/service/org/cs/',//获坐席息详情
        'zuoxi_create' => 'http://' . HOST . '/service/org/cs/create',//创建坐席
        'zuoxi_query' => 'http://' . HOST . '/service/org/cs/query',// 查询坐席
        'zuoxi_update' => 'http://' . HOST . '/service/org/cs/update',//更新坐席
        'zuoxi_del' => 'http://' . HOST . '/service/org/cs/delete/',//更新坐席

        'get_area' => 'http://' . HOST . '/service/region/get',//获取行政区域

        'notice_query' => 'http://' . HOST . '/service/notice/org/query',//查询代理通知
        'notice_del' => 'http://' . HOST . '/service/notice/org/delete',//删除通知

        'health_query' => 'http://' . HOST . '/service/health/breath/get/page',//健康监控
        'history' => 'http://' . HOST . '/service/health/breath/get/history/',  //历史数据

        'people_query' => 'http://' . HOST . '/service/people/get/basic/page', //老人基础档案分页查询
        'people_save_edit' => 'http://' . HOST . '/service/people/saveOrUpdate/detail', //新增/更新老人基础档案
        'people_detail' => 'http://' . HOST . '/service/people/get/detail/',//获取老人基础信息

        'warning_list' => 'http://' . HOST . '/service/device/alarm/get/page',//设备报警分页
        'warning_detail' => 'http://' . HOST . '/service/device/alarm/get/detail/',//获取设备详情
        'warning_history' => 'http://' . HOST . '/service/device/alarm/get/history/page', //设备历史报警
        'warning_add_deal' => 'http://' . HOST . '/service/device/alarm/process/create',//新增报警处理记录
        'warning_deal' => 'http://' . HOST . '/service/device/alarm/close',//报警处理

        'health_medication_query' => 'http://' . HOST . '/service/medication/remind/get/page',//用药提醒列表
        'health_medication_detail' => 'http://' . HOST . '/service/medication/remind/get/detail/',//用药提醒详情
        'remind_add' => 'http://' . HOST . '/service/medication/remind/create',//添加提醒用药
        'close_remind' => 'http://' . HOST . '/service/medication/remind/close/',//关闭提醒
        'userhealth_query' => 'http://' . HOST . '/service/health/get/page',//健康档案列表
        'userhealth_detail' => 'http://' . HOST . '/service/health/get/detail/',//健康档案详情
        'userhealth_edit' => 'http://' . HOST . '/service/health/saveOrUpdate/basic',//编辑健康档案
        'consultant_add' => 'http://' . HOST . '/service/health/consult/saveOrUpdate',//添加咨询
        'breathe_add' => 'http://' . HOST . '/service/health/breath/saveOrUpdate',//添加修改呼吸心率
        'breathe_history' => 'http://' . HOST . '/service/health/breath/get/all/',//呼吸心率历史
        'breathe_del' => 'http://' . HOST . '/service/health/breath/delete/',//删除呼吸
        'pressure_add' => 'http://' . HOST . '/service/health/bloodPressure/saveOrUpdate',//添加修改血压
        'pressure_history' => 'http://' . HOST . '/service/health/bloodPressure/get/all/',//血压历史
        'pressure_del' => 'http://' . HOST . '/service/health/bloodPressure/delete/',//删除血压
        'glucose_add' => 'http://' . HOST . '/service/health/bloodGlucose/saveOrUpdate',//血糖添加修改
        'glucose_hisotory' => 'http://' . HOST . '/service/health/bloodGlucose/get/all/',//血糖历史
        'glucose_del' => 'http://' . HOST . '/service/health/bloodGlucose/delete/',//血糖删除
        'oxygen_add' => 'http://' . HOST . '/service/health/bloodOxygen/saveOrUpdate',//添加修改血氧
        'oxygen_history' => 'http://' . HOST . '/service/health/bloodOxygen/get/all/',//血氧历史
        'oxygen_del' => 'http://' . HOST . '/service/health/bloodOxygen/delete/',//血氧删除
        'bmi_add' => 'http://' . HOST . '/service/health/bmi/saveOrUpdate',//bmi添加修改
        'bmi_history' => 'http://' . HOST . '/service/health/bmi/get/all/',//bmi历史
        'bmi_del' => 'http://' . HOST . '/service/health/bmi/delete/',//bmi删除
        'bmi_latest'=>'http://' . HOST . '/service/health/bmi/latest/get',//最新一条BMI

        'get_right' => 'http://' . HOST . '/service/perm/modules/',//获取某个用户所有权限
        'get_auth' => 'http://' . HOST . '/service/perm/modules/support/',//获取权限

        'feeback' => 'http://' . HOST . '/service/feedback/get/page',//意见反馈
        'del_feeback' => 'http://' . HOST . '/service/feedback/delete/',//删除意见反馈

        'send_broadcast' => 'http://' . HOST . '/service/msg/broadcast/send',//发送广播
        'del_broadcast' => 'http://' . HOST . '/service/msg/broadcast/delete',//删除广播
        'query_broadcast' => 'http://' . HOST . '/service/msg/broadcast/query?pageNo=',//查询广播

        'send_sms'=>'http://' . HOST . '/service/sms/send',//发送短信验证码

        'notice_set_read'=>'http://'.HOST.'/service/notice/org/setread',//通知设置阅读状态

        'notice_get_count'=>'http://'.HOST.'/service/notice/org/get/count',//获取通知未读数量

        'statistics_total_users'=>'http://'.HOST.'/service/statistics/org/user/',//根据运营商ID获取用户数
        'statistics_new_users'=>'http://'.HOST.'/service/statistics/org/user/sub/',//运营商新增用户统计

        'video_basic_info'=>'http://'.HOST.'/service/people/info/get',//视频中老人信息

        'health_report_info'=>'http://'.HOST.'/service/health/report/basic/data/get',//健康报告老人基础信息
        'heart_or_breath'=>'http://'.HOST.'/service/sign/data/querySignStatistics',//心率/呼吸查询
        'five_heart_or_breath'=>'http://'.HOST.'/service/doctor/five/sign',//心率/呼吸查询
        'blood_oxygen'=>'http://'.HOST.'/service/health/bloodOxygen/latest/days/get',//血氧
        'blood_pressure'=>'http://'.HOST.'/service/health/bloodPressure/latest/days/get',//血压
        'blood_glucose'=> 'http://'.HOST.'/service/health/bloodGlucose/latest/days/get',//血糖
        'sleep_yesterday'=> 'http://'.HOST.'/service/sign/data/querySleepData',//昨天睡眠
        'sleep_history'=> 'http://'.HOST.'/service/sign/data/querySleepHistoryData',//历史睡眠

    ),
);
