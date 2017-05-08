<?php
// +----------------------------------------------------------------------
// | OneThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.onethink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: 麦当苗儿 <zuojiazi@vip.qq.com> <http://www.zjzit.cn>
// +----------------------------------------------------------------------

namespace Home\Controller;

use Think\Controller;

/**
 * 前台公共控制器
 * 为防止多分组Controller名称冲突，公共Controller名称统一使用分组名称
 */
class HomeController extends Controller
{

    /* 空操作，用于输出404页面 */
    public function _empty()
    {
        $this->redirect('Index/index');
    }


    protected function _initialize()
    {
        $Contact = M('Contact')->find();
        /* 读取站点配置 */
        $config = api('Config/lists');
        C($config); //添加配置
        $this->assign('contact',$Contact);
        if (!C('WEB_SITE_CLOSE')) {
            $this->error('站点已经关闭，请稍后访问~');
        }

        //产品介绍和解决方案子菜单
        $productList=get_child_category('product_introduce');
        $soulationList=get_child_category('product_instruction');
        $this->assign('navProductList',$productList);
        $this->assign('navSoulationList',$soulationList);
    }

    /* 用户登录检测 */
    protected function login()
    {
        /* 用户登录检测 */
        is_login() || $this->error('您还没有登录，请先登录！', U('User/login'));
    }

}
