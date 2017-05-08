<?php
namespace Home\Controller;

class ProductController extends HomeController
{
    function index()
    {
        $name = I('name');
        if (empty($name)) {
            $name = 'p1';
        }
        $productPicture = M('Picture')->where(['deleted' => 0, 'marks' => $name])->select();
        $this->assign('title', 'VR-产品介绍');
        $this->assign('productPicture', $productPicture);
        $this->display();
    }
}