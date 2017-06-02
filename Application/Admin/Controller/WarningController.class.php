<?php
namespace Admin\Controller;

class WarningController extends AdminController
{
    function warning_detail()
    {

        $this->display();
    }

    function warning_history()
    {
        $this->meta_title = "历史报警";
        $this->display();
    }
}