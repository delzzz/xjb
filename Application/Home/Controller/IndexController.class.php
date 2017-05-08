<?php
// +----------------------------------------------------------------------
// | OneThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.onethink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: 麦当苗儿 <zuojiazi@vip.qq.com> <http://www.zjzit.cn>
// +----------------------------------------------------------------------

namespace Home\Controller;

use OT\DataDictionary;

/**
 * 前台首页控制器
 * 主要获取首页聚合数据
 */
class IndexController extends HomeController
{
    //系统首页
    public function index()
    {
        $bannerList = M('FrontPicture')->where(['type' => 'banner', 'deleted' => 0])->select();
        $indexProduct = get_document('index_product', 2); //首页产品
        $indexProductIntroduce = get_document('index_prodecut_descript', 2); //首页产品描述
        $fp = M('front_picture')->field(['picture_id'])->where(['type' => 'video'])->order('id desc')->find();//video表
        $videoInfo = M('file')->where(['id'=>$fp['picture_id']])->select();//video详情
        $this->assign('title', 'VR-首页');
        $this->assign('productIntroduce', $indexProductIntroduce);
        $this->assign('productList', $indexProduct);
        $this->assign('bannerList', $bannerList);
        $this->assign('videoInfo',$videoInfo[0]);
        $this->display();
    }

}