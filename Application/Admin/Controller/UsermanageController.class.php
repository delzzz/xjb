<?php
namespace Admin\Controller;

class UsermanageController extends AdminController
{
    function user_list()
    {
        $this->meta_title = "坐席列表";
        $this->display();
    }

    function user_manage()
    {
        $this->meta_title = "坐席管理";
        $this->display();
    }

    function write()
    {
        $param = $_POST;
        $ocs = $param;
        $ocs['orgId'] = $this->orgId();
        $ocs['orgType'] = $this->orgType();
        unset($ocs['password']);
        unset($ocs['repassword']);
        $user = ['password' => $param['password']];
        $photo = ['displayName' => '', 'imagePath' => 'xxxx'];
        $data = ['ocs' => $ocs, 'user' => $user, 'photo' => $photo];
        $json_data = think_json_encode($data);
        $url = $this->getUrl('zuoxi_create');
        $response = http_post_json($url, $json_data);
        if ($response['success']) {
            $this->success('保存成功');
        } else {
            $this->error('保存失败');
        }
    }
}