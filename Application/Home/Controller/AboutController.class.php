<?php
namespace Home\Controller;

class AboutController extends HomeController
{
    function index()
    {
        $aboutUs = get_document_one('about_us');
        $this->assign('title','VR-关于我们');
        $this->assign('aboutUs', $aboutUs);
        $this->display();
    }

    function write()
    {
        $param = I('post.');
        $param['address'] = '';
        if (!empty($param['city'])) {
            $param['address'] .= $param['city'] . '省';
        }
        if (!empty($param['smcity'])) {
            $param['address'] .= $param['smcity'] . '市';
        }
        $param['create_time'] = time();
        $Msg = M('Message');
        $data = $Msg->create($param);
        if ($data && $Msg->add()) {
            $this->success('success');
        } else {
            $this->error('faild');
        }
    }
}