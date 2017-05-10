<?php
namespace Admin\Controller;

use Think\Controller;

class IndexController extends Controller
{
    function index()
    {
        $this->display('index');
    }
}