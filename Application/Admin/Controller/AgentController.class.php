<?php
namespace Admin\Controller;

class AgentController extends AdminController
{
    function index()
    {
        $this->display();
    }

    function agent()
    {
        $this->display('agent');
    }

    function agent2()
    {
        $this->meta_title = "保存代理机构信息";
        $this->display('agent2');
    }

    function write()
    {
        $param=I();
        print_r($param);die();
    }
}