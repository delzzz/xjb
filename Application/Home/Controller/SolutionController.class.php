<?php
namespace Home\Controller;

class SolutionController extends HomeController
{
    public function index()
    {
        $name = I('name');
        if (empty($name)) {
//            $name = 'product_instruction';
            $name = 's1'; //默认第一类
        }
        $Solution = get_document($name, 1);
        $this->assign('title', 'VR-解决方案');
        $this->assign('solution', $Solution[0]);
        $this->display();
    }
}