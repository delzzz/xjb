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
        $this->meta_title = "添加代理商";
        $this->display('agent');
    }

    function agent2()
    {
        $this->meta_title = "保存代理机构信息";
        $this->display('agent2');
    }

    function write()
    {
        $param = $_POST;
        print_r($param);
        die();
    }
    function addAgent(){
        $param = $_POST;
        var_dump($_POST);
        $info['orgInfo']['orgOrganization']['orgName'] = $param['orgName'];
        $info['orgInfo']['orgOrganization']['orgCode'] = $param['orgCode'];
        $info['orgInfo']['orgOrganization']['telephone'] = $param['telephone'];
        $info['orgInfo']['orgOrganization']['address'] = $param['address'];
        $info['orgInfo']['orgOrganization']['remark'] = $param['remark'];
        $info['orgInfo']['orgContactList'][0]['name'] = $param['name'][0];
        $info['orgInfo']['orgContactList'][0]['mobile'] = $param['mobile'][0];
        $info['orgInfo']['orgContactList'][0]['contactType'] = 0;
        $info['orgInfo']['orgContactList'][0]['idNo'] = $param['idNo'][0];
        $info['orgInfo']['orgContactList'][1]['name'] = $param['name'][1];
        $info['orgInfo']['orgContactList'][1]['mobile'] = $param['mobile'][1];
        $info['orgInfo']['orgContactList'][1]['contactType'] = 1;
        $info['orgInfo']['orgContactList'][1]['idNo'] = $param['idNo'][1];
        $info['orgInfo']['imageList']['imagePath'] = $param['imagePath'];
        $info['orgInfo']['orgDevice']['deviceType'] = implode(',',$param['deviceType']);
        $info['orgInfo']['orgDevice']['quantity'] = $param['quantity'];
        $info['orgInfo']['sysUserInfo']['password'] = $param['password'];
        $info['orgAgent']['parentId'] = 1;
        $info['orgAgent']['degree'] = $param['degree'];
        $info['orgAgent']['provinceId'] = $param['provinceId'];
        $info['orgAgent']['cityId'] = $param['cityId'];
        $info['orgAgent']['countyId'] = $param['countyId'];
        $info['orgAgent']['extendFlag'] = !$param['extendFlag']?0:1;
        var_dump(json_encode($info));
        $result = http('http://host/service/org/agent/create',json_encode($info),post);
        var_dump($result);

    }
}