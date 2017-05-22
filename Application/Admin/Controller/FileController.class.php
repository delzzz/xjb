<?php
// +----------------------------------------------------------------------
// | OneThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.onethink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: 麦当苗儿 <zuojiazi@vip.qq.com> <http://www.zjzit.cn>
// +----------------------------------------------------------------------
namespace Admin\Controller;

use Think\Upload\Driver\Qiniu\QiniuStorage;

/**
 * 文件控制器
 * 主要用于下载模型的文件上传和下载
 */
class FileController extends AdminController
{

    /* 文件上传 */
    public function upload()
    {
        $File = D('File');
        $info = $File->upload(
            $_FILES,
            C('DOWNLOAD_UPLOAD'),
            'Qiniu',
            C("UPLOAD_QINIU_CONFIG")
        );
        /* 返回JSON数据 */
        echo $info['file']['url'];
        die();
        $this->ajaxReturn($info);
    }

    /* 下载文件 */
    public function download($id = null)
    {
        if (empty($id) || !is_numeric($id)) {
            $this->error('参数错误！');
        }

        $logic = D('Download', 'Logic');
        if (!$logic->download($id)) {
            $this->error($logic->getError());
        }

    }

    //删除图片
    public function delPic()
    {
        $imageId = I('get.imageId');
        $baseUrl = $this->getUrl('del_pic');
        $url = $baseUrl . $imageId;
        $response = http($url, null, 'GET');
        echo json_encode($response);
    }

    /**
     * 上传图片
     * @author huajie <banhuajie@163.com>
     */
    public function uploadPicture()
    {
        //TODO: 用户登录检测

        /* 返回标准数据 */
        $return = array('status' => 1, 'info' => '上传成功', 'data' => '');

        /* 调用文件上传组件上传文件 */
        $Picture = D('Picture');
        $pic_driver = C('PICTURE_UPLOAD_DRIVER');
        $info = $Picture->upload(
            $_FILES,
            C('PICTURE_UPLOAD'),
            C('PICTURE_UPLOAD_DRIVER'),
            C("UPLOAD_{$pic_driver}_CONFIG")
        ); //TODO:上传到远程服务器

        /* 记录图片信息 */
        if ($info) {
            $return['status'] = 1;
            $return = array_merge($info['download'], $return);
        } else {
            $return['status'] = 0;
            $return['info'] = $Picture->getError();
        }

        /* 返回JSON数据 */
        $this->ajaxReturn($return);
    }
}
