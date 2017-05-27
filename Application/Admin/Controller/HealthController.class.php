<?php
namespace Admin\Controller;

class HealthController extends AdminController
{
    function index()
    {
        $this->meta_title = "健康监控";
        $this->display();
    }

    function add()
    {
        $this->display();
    }

    function detail()
    {
        $this->display();
    }

    function medication()
    {
        $this->display();
    }
}