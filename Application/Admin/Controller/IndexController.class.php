<?php
namespace Admin\Controller;

use Think\Controller;

class IndexController extends AdminController
{
    function index()
    {
        $this->display('index');
    }
}