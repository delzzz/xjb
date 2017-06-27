<?php
namespace Admin\Controller;

class UsermanageController extends AdminController
{
    function user_list()
    {
        $this->meta_title = "坐席列表";
        $pageNo = I('get.p', 1);
        $name = I('get.name');
        $url = $this->getUrl('zuoxi_query') . '?pageNo=' . $pageNo . '&pageSize=' . C('PAGE_SIZE');
        $param = think_json_encode(['orgId' => $this->orgId(), 'name' => $name]);
        $list = $this->lists($url, $param);
        int_to_string($list['itemList'], ['sex' => ['0' => "女", '1' => "男"]]);
        $this->assign('list', $list['itemList']);
        $this->assign('name', $name);
        $this->display();
    }

    function user_manage()
    {
        $this->meta_title = "坐席管理";
        $csId = I('get.csId');
        $right = get_auth(3);
        if (empty($csId)) {
            $right = $this->getRight();
            $csId = get_user_auth()['objectId'];
        }
        $url = $this->getUrl('zuoxi_detail') . $csId;
        $response = http($url, null, 'GET');
        $this->assign('info', $response);
        $this->assign('img', $response['photo']);
        $this->assign('right', $right);

        $this->display();
    }

    function del()
    {
        $csId = I('get.csId');
        $url = $this->getUrl('zuoxi_del') . $csId;
        http($url, null, 'GET');
        $this->success('删除成功', U('user_list'));
    }

    function write()
    {
        $param = $_POST;
        $ocs = $param;
        $ocs['orgId'] = $this->orgId();
        $ocs['orgType'] = $this->orgType();
        unset($ocs['password']);
        unset($ocs['repassword']);
        unset($ocs['imagePath']);
        $user = ['password' => $param['password']];
        $photo = ['displayName' => '', 'imagePath' => $param['imagePath']];
        $data = ['ocs' => $ocs, 'user' => $user, 'photo' => $photo];
        $url = $this->getUrl('zuoxi_create');
        if ($param['csId']) {
            if ($param['imageId']) {
                $data['photo']['imageId'] = $param['imageId'];
            }
            unset($data['ocs']['orgId']);
            unset($data['ocs']['orgType']);
            unset($data['user']);
            //删除图片
            $url = $this->getUrl('zuoxi_update');
        } else {
            unset($data['ocs']['csId']);
        }
        unset($data['ocs']['imageId']);
        unset($data['ocs']['imagePath']);
        $json_data = think_json_encode($data);
        $response = http_post_json($url, $json_data);
        if ($response['success']) {
            $this->success('保存成功', U('user_list'));
        } else {
            $this->error('保存失败');
        }
    }
}