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
        $this->meta_title = "当前账号管理";
        $auth = $this->getAuth();
        $this->assign('auth', $auth);
        $url = C('INTERFACR_API')['get_user'];
        $userinfo = session('user_auth');
        $User = http($url, ['userName' => $userinfo['userName']], 'GET');
        $this->assign('uinfo', $User);
        if($userinfo['userType'] == 1){
            //代理商
            $agentId = $this->agentId();
            $this->manage_agent($agentId);
            $this->display('agent_detail');
        }
        elseif ($userinfo['userType'] == 2){
            //机构
            $this->manage_ins();
            $this->display('ins_detail');
        }
        elseif ($userinfo['userType'] == 3) {
            //坐席
            $url = $this->getUrl('zuoxi_detail') . $userinfo['objectId'];
            $response = http($url, null, 'GET');
//            $moduleStr = '';
            $this->assign('img', $response['photo']);
            $this->assign('res',$response);
//            foreach ($response['moduleList'] as $key=>$value){
//                $moduleStr .= $value['roleModuleId'].',';
//            }
//            $this->assign('moduleStr',$moduleStr);
            $this->assign('moduleList',$response['moduleList']);
            $this->display();
        }
    }
    //代理商详情
    function manage_agent($agentId){
        $info = get_agent_info($agentId);
        $this->assign('info', $info);
        $agentDetail = $this->getUrl('get_agent_detail');
        $manageInfo = http($agentDetail . $agentId, null, 'get');
        $this->assign('manageInfo', $manageInfo);
        //图片
        $imgList = $manageInfo['orgOrganization']['imageList'];
        $imgPath = '';
        $count = count($imgList);
        $i = 0;
        foreach ($imgList as $val) {
            $i++;
            if ($count == 1) {
                $imgPath = $val['imagePath'];
                $imgIdStr = $val['imageId'];
            } elseif ($i > 1 && $i == $count) {
                $imgPath .= $val['imagePath'];
                $imgIdStr .= $val['imageId'];
            } else {
                $imgPath .= $val['imagePath'] . ',';
                $imgIdStr .= $val['imageId'] . ',';
            }
        }
        $this->assign('imgList', $imgList);
        $this->assign('imgPathStr', $imgPath);
        $this->assign('imgIdStr', $imgIdStr);
        //权限
        $moduleList = $manageInfo['orgOrganization']['moduleList'];
        $this->assign('moduleList',$moduleList);
//        $moduleStr='';
//        foreach ($moduleList as $key=>$value){
//            $moduleStr .= $value['moduleId'].',';
//        }
//        $this->assign('moduleStr',$moduleStr);
        $device_type = C('DEVICE_TYPE');
        $this->assign('device_type',$device_type);
        if(isset($_SESSION['verifyTrue'])){
            $vfyTrue = $_SESSION['verifyTrue'];
        }
        else{
            $vfyTrue = 0;
        }
        $this->assign('verifyTrue',$vfyTrue);
    }
    //机构详情
    function manage_ins(){
        $ins = $this->orgIns();
        $option = $ins;
        $agentId = $option['agentId'];
        $option = get_ins_detail($option['institutionId']);
        $moduleList = $option['orgOrganization']['moduleList'];
        $this->assign('moduleList',$moduleList);
//        $moduleStr='';
//        foreach ($moduleList as $key=>$value){
//            $moduleStr .= $value['moduleId'].',';
//        }
//        $this->assign('moduleStr',$moduleStr);
        $parentId = get_agent_info($agentId)['parentId'];
        $this->assign('insId', $option['institutionId']);
        $imgList = $option['orgOrganization']['imageList'];
        $imgPath = '';
        $count = count($imgList);
        $i = 0;
        foreach ($imgList as $val) {
            $i++;
            if ($count == 1) {
                $imgPath = $val['imagePath'];
                $imgIdStr = $val['imageId'];
            } elseif ($i > 1 && $i == $count) {
                $imgPath .= $val['imagePath'];
                $imgIdStr .= $val['imageId'];
            } else {
                $imgPath .= $val['imagePath'] . ',';
                $imgIdStr .= $val['imageId'] . ',';
            }
        }
        $device_type = C('DEVICE_TYPE');
        $org_condition = C('ORG_CONDITION');
        $this->assign('org_condition', $org_condition);
        $this->assign('device_type', $device_type);
        $this->assign('info', $option);
        $this->assign('orgInfo', $option['orgOrganization']);
        $this->assign('contactList', $option['orgOrganization']['contactList']);
        $this->assign('imgList', $imgList);
        $this->assign('imgPathStr', $imgPath);
        $this->assign('imgIdStr', $imgIdStr);
        $this->assign('orgDevice', $option['orgOrganization']['orgDevice']);
        if(isset($_SESSION['verifyTrue'])){
            $vfyTrue = $_SESSION['verifyTrue'];
        }
        else{
            $vfyTrue = 0;
        }
        $this->assign('verifyTrue',$vfyTrue);
    }
    //修改坐席页面
    function update_user()
    {
        $this->meta_title = '修改坐席';
        $right = get_auth(3);
        $csId = I('get.csId');
        $url = $this->getUrl('zuoxi_detail') . $csId;
        $response = http($url, null, 'GET');
        $this->assign('info', $response);
        $this->assign('moduleList',$response['moduleList']);
        $this->assign('auth', $right);
        $this->assign('img', $response['photo']);
        $this->display();
    }

    //获取权限
    function getAuth()
    {
        $userType = $_SESSION['onethink_admin']['user_auth']['userType'];
        $res = get_auth($userType);
        return $res;
    }

    function del()
    {
        $csId = I('get.csId');
        $url = $this->getUrl('zuoxi_del') . $csId;
        http($url, null, 'GET');
        $this->success('删除成功', U('user_list'));
    }

    //修改坐席
    function write()
    {
        $param = $_POST;
        $ocs = $param;
        $ocs['orgId'] = $this->orgId();
        $ocs['orgType'] = $this->orgType();
        unset($ocs['password']);
        unset($ocs['repassword']);
        unset($ocs['imagePath']);
        unset($ocs['roleModuleIds']);
        $user = ['password' => $param['password']];
        $photo = ['displayName' => '', 'imagePath' => $param['imagePath']];
        $data = ['ocs' => $ocs, 'user' => $user, 'permInfo' => ['roleModuleIds' => $param['roleModuleIds']], 'photo' => $photo];
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
        unset($data['ocs']['flag']);
        $json_data = think_json_encode($data);
        $response = http_post_json($url, $json_data);
        if ($response['success']) {
            if(isset($_POST['flag'])){
                $this->success('保存成功');
            }
            else{
                $this->success('保存成功', U('user_list'));
            }
        } else {
            $this->error('保存失败');
        }
    }

    //新增坐席页面
    function add_user()
    {
        $this->meta_title='新增坐席';
        $right = get_auth(3);
        $csId = I('get.csId');
        $this->assign('auth', $right);
        $this->display();
    }
    //新增坐席
    function add()
    {
        $param = $_POST;
        $ocs = $param;
        $ocs['orgId'] = $this->orgId();
        $ocs['orgType'] = $this->orgType();
        unset($ocs['password']);
        unset($ocs['repassword']);
        unset($ocs['imagePath']);
        unset($ocs['roleModuleIds']);
        $user = ['password' => $param['password']];
        $photo = ['displayName' => '', 'imagePath' => $param['imagePath']];
        $data = ['ocs' => $ocs, 'user' => $user, 'permInfo' => ['roleModuleIds' => $param['roleModuleIds']], 'photo' => $photo];
        $url = $this->getUrl('zuoxi_create');
        unset($data['ocs']['csId']);
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