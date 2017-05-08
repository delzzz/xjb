<?php
namespace Home\Controller;

class AdvertiesController extends HomeController
{
    function index()
    {
        $this->assign('title','VR-招贤纳士');
        $jobList=M('JobInfo')->where(['deleted'=>0])->select();
//        print_r($jobList);die();
        $this->assign('jobList',$jobList);
        $this->display();
    }
}