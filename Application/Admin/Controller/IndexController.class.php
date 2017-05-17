<?php
namespace Admin\Controller;

use Think\Controller;

class IndexController extends AdminController
{
    function index()
    {
        $this->meta_title = '首页';
        $this->display('index');
    }
}