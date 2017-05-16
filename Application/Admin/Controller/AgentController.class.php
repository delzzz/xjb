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
        $this->display('agent2');
    }
}