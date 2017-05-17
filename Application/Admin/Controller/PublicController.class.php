<?php
namespace Admin\Controller;

class PublicController extends AdminController
{
    function login()
    {
        if(isset($_POST['username'])){
        }
        $this->display();
    }
}