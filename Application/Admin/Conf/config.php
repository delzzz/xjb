<?php
// +----------------------------------------------------------------------
// | OneThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.onethink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: 麦当苗儿 <zuojiazi@vip.qq.com> <http://www.thinkphp.cn>
// +----------------------------------------------------------------------

/**
 * 前台配置文件
 * 所有除开系统级别的前台配置
 */
return array(
    /*页面显示条数*/
    'PAGE_SIZE' => '2',
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
        '经济来源',
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
        '歌舞',
        '下棋',
        '书法',
        '乐器',
        '晨练',
        '逛公园'
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

    'BLOOD_TYPE' =>
        [
            'A',
            'B',
            'AB',
            'O'
        ],

    /*接口配置*/
    'INTERFACR_API' => array(
        'agent_create' => 'http://192.168.1.250:8080/service/org/agent/create',//创建代理商
        'agent_update' => 'http://192.168.1.250:8080/service/org/agent/update',//更新代理商
        'get_agent_detail' => 'http://192.168.1.250:8080/service/org/agent/detail/',//获取代理商详情
        'ins_create' => 'http://192.168.1.250:8080/service/org/ins/create', //创建机构

        'ins_update' => 'http://192.168.1.250:8080/service/org/ins/update',//更新机构
        'get_agent' => 'http://192.168.1.250:8080/service/org/agent/',//根据代理商ID获取代理商详情
        'agent_collocation' => 'http://192.168.1.250:8080/service/org/agent/collocation',//代理商托管
        'ins_collocation' => 'http://192.168.1.250:8080/service/org/ins/collocation',//机构托管

        'get_user' => 'http://192.168.1.250:8080/service/sys/user/get', //获取系统用户信息
        'get_org_agent' => 'http://192.168.1.250:8080/service/org/agent/get',//获取代理商
        'query_org' => 'http://192.168.1.250:8080/service/org/ins/query',//查询机构
        'query_agent' => 'http://192.168.1.250:8080/service/org/agent/query',//查询代理商
        'get_org_detail' => 'http://192.168.1.250:8080/service/org/ins/detail/', //获取机构详情
        'del_pic' => 'http://192.168.1.250:8080/service/image/delete/',//删除图片

        'zuoxi_detail' => 'http://192.168.1.250:8080/service/org/cs/',//获坐席息详情
        'zuoxi_create' => 'http://192.168.1.250:8080/service/org/cs/create',//创建坐席
        'zuoxi_query' => 'http://192.168.1.250:8080/service/org/cs/query',// 查询坐席
        'zuoxi_update' => 'http://192.168.1.250:8080/service/org/cs/update',//更新坐席
        'zuoxi_del' => 'http://192.168.1.250:8080/service/org/cs/delete/',//更新坐席

        'get_area' => 'http://192.168.1.250:8080/service/region/get',//获取行政区域

        'notice_query' => 'http://192.168.1.250:8080/service/notice/org/query',//查询代理通知
        'notice_del' => 'http://192.168.1.250:8080/service/notice/org/delete',//删除通知

        'health_query' => 'http://192.168.1.250:8080/service/health/breath/get/page',//健康监控
        'history' => 'http://192.168.1.250:8080/service/health/breath/get/history/',  //历史数据

        'people_query' => 'http://192.168.1.250:8080/service/people/get/basic/page', //老人基础档案分页查询
        'people_save_edit' => 'http://192.168.1.250:8080/service/people/saveOrUpdate/detail', //新增/更新老人基础档案
        'people_detail' => 'http://192.168.1.250:8080/service/people/get/detail/'//获取老人基础信息
    ),
);
