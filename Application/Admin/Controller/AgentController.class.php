<?php
namespace Admin\Controller;

use Admin\Controller\AreaController;

class AgentController extends AdminController
{
    function index()
    {
        $this->meta_title = '代理商管理';
        if (I('get.p')) {
            $this->assign('current_p', I('get.p'));
        }
        if (I('get.p2')) {
            $this->assign('current_p2', I('get.p2'));
        }
        //代理商托管
        if ($_POST['agentId']) {
            $sourceId = $_POST['agentId'];
            $targetId = $_POST['targetId'];
            //托管还是重新托管
            if (empty($_POST['collocationId'])) {
                $collocate = deposit_agent($sourceId, $targetId);
            } else {
                $this->updateCollocation($_POST['collocationId'], $targetId);
            }
            $collocation = get_querySource($sourceId);
            $collocationInfo[0] = $this->collocationList($sourceId, $targetId, $collocation[0]['collocationId'], 1);
            $collocationInfo[0]['targetId'] = $collocation[0]['targetId'];
            echo 2;exit();
        } else {
            //查询下级是否有托管操作
            $agentId = $this->agentId();
            $agentId = $agentId == '' ? 1 : $agentId;
            $agents = $this->agentList2($agentId);
            $agentString = '';
            foreach ($agents as $key => $value) {
                $agentString .= $value['agentId'] . ',';
            }
            $agentString = substr($agentString, 0, strlen($agentString) - 1);
            $agent_arr = explode(',', $agentString);
            foreach ($agent_arr as $key => $value) {
                $bool_value = is_collocation($value);
                if ($bool_value) {
                    $querySourceInfo[] = get_querySource($value)[0];
                }
            }
            foreach ($querySourceInfo as $k => $v) {
                $collocationInfo[] = $this->collocationList($v['sourceId'], $v['targetId'], $v['collocationId'], 1);
            }
            //查询是否有代理商托管给自己
            $targetAgents = get_queryTarget($agentId);
            foreach ($targetAgents as $key => $value) {
                if ($value['targetId'] != $agentId) {
                    unset($targetAgents[$key]);
                }
            }
            foreach ($targetAgents as $k => $v) {
                $collocationInfo[] = $this->collocationList($v['sourceId'], $v['targetId'], $v['collocationId'], 2);
            }
        }
        $this->assign('collocationInfo', $collocationInfo);
        $this->assign('agentList', $this->agentList());
        $this->assign('orgList', $this->orgList());
        //代理商统计
        $agentStatistics = agent_statistics($agentId);
        $orgAgent = $this->orgAgent();
        $this->assign('degree', $orgAgent['degree']);
        $this->assign('agentStatistics', $agentStatistics);
        $this->display();
    }

    //托管信息
    function collocationList($sourceId, $targetId, $collocationId, $type)
    {
        $sourceInfo = get_agent_info($sourceId);
        $targetInfo = get_agent_info($targetId);
        $area = new AreaController();
        if ($sourceInfo['degree'] == 1) {
            $sourceName = $area->getName($sourceInfo['provinceId'], 0, 1) . '一级代理';
        } elseif ($sourceInfo['degree'] == 2) {
            $sourceName = $area->getName($sourceInfo['cityId'], $sourceInfo['provinceId'], 2) . '二级代理';
        } elseif ($sourceInfo['degree'] == 3) {
            $sourceName = $area->getName($sourceInfo['countyId'], $sourceInfo['cityId'], 3) . '三级代理';
        } else {
            $sourceName = '官方代理';
        }

        if ($targetInfo['degree'] == 1) {
            $targetName = $area->getName($targetInfo['provinceId'], 0, 1) . '一级代理';
        } elseif ($targetInfo['degree'] == 2) {
            $targetName = $area->getName($targetInfo['cityId'], $targetInfo['provinceId'], 2) . '二级代理';
        } elseif ($targetInfo['degree'] == 3) {
            $targetName = $area->getName($targetInfo['countyId'], $targetInfo['cityId'], 3) . '三级代理';
        } else {
            $targetName = '官方代理';
        }
        $info['sourceName'] = $sourceInfo['orgOrganization']['orgName'] . '(' . $sourceName . ')';
        $info['targetName'] = $targetInfo['orgOrganization']['orgName'] . '(' . $targetName . ')';
        //托管方的下级代理
        $sourceAgents = $this->agentList2($sourceId);
        $sourceIns = $this->orgList2($sourceId);
        $info['sourceAgents'] = $sourceAgents;
        $info['sourceIns'] = $sourceIns;
        $info['sourceId'] = $sourceId;
        $info['targetId'] = $targetId;
        $info['collocationId'] = $collocationId;
        $info['type'] = $type;
        return $info;
    }

    //下级代理商
    function agentList($agentId = 0)
    {
        if (empty($agentId)) {
            $agentId = $this->agentId() == '' ? 1 : $this->agentId();
        }
        $pageNo = I('get.p2', 1);
        $pageSize = C('PAGE_SIZE');
        $url = C('INTERFACR_API')['query_agent'] . '?pageNo=' . $pageNo . '&pageSize=' . $pageSize;
        $param = think_json_encode(['parentId' => $agentId]);
        $lists = $this->lists2($url, $param);
        $agentLists = $lists['itemList'];
        $this->assign('totalPage', $lists['totalPage']);
        $area = new AreaController();
        foreach ($agentLists as $key => &$value) {
            if (is_collocation($value['agentId'])) {
                //托管中
                $value['c_status'] = 1;
            } else {
                if ($value['userStatus'] == 1) {
                    //已托管
                    $value['c_status'] = 2;
                } else {
                    //未托管
                    $value['c_status'] = 0;
                }
            }
            //date类型去除后面000
            $value['createTime'] = substr($value['createTime'], 0, strlen($value['createTime']) - 3);
            $value['updateTime'] = substr($value['updateTime'], 0, strlen($value['updateTime']) - 3);
            $value['area'] = $area->getFullName($value['provinceId'], $value['cityId'], $value['countyId'], $value['degree']);
            if (agent_list($value['agentId']) != null) {
                $value['child'] = agent_list($value['agentId']);
            }
            if ($value['child'] != null) {
                foreach ($value['child'] as $k => &$v) {
                    //date类型去除后面000
                    $v['createTime'] = substr($v['createTime'], 0, strlen($v['createTime']) - 3);
                    $v['updateTime'] = substr($v['updateTime'], 0, strlen($v['updateTime']) - 3);
                    $v['area'] = $area->getFullName($v['provinceId'], $v['cityId'], $v['countyId'], $v['degree']);
                    if (agent_list($v['agentId']) != null) {
                        $value['child'][$k]['children'] = agent_list($v['agentId']);
                    }
                    if ($v['children'] != null) {
                        foreach ($v['children'] as $kk => &$vv) {
                            //date类型去除后面000
                            $vv['createTime'] = substr($vv['createTime'], 0, strlen($vv['createTime']) - 3);
                            $vv['updateTime'] = substr($vv['updateTime'], 0, strlen($vv['updateTime']) - 3);
                            $vv['area'] = $area->getFullName($vv['provinceId'], $vv['cityId'], $vv['countyId'], $vv['degree']);
                        }
                    }
                }
            }
        }
        return $agentLists;
    }

    //同级代理商
    function agentList2($agentId = 0)
    {
        if (empty($agentId)) {
            $agentId = $this->agentId();
        }
        $agentLists = agent_list($agentId);
        $area = new AreaController();
        foreach ($agentLists as $key => &$value) {
            //date类型去除后面000
            $value['createTime'] = substr($value['createTime'], 0, strlen($value['createTime']) - 3);
            $value['updateTime'] = substr($value['updateTime'], 0, strlen($value['updateTime']) - 3);
            $value['area'] = $area->getFullName($value['provinceId'], $value['cityId'], $value['countyId'], $value['degree']);
        }
        return $agentLists;
    }

    function orgList($agentId = 0)
    {
        if (empty($agentId)) {
            $agentId = $this->agentId();
        }
        $pageNo = I('get.p', 1);
        $url = C('INTERFACR_API')['query_org'] . '?pageNo=' . $pageNo . '&pageSize=' . C('PAGE_SIZE');
        $param = think_json_encode(['agentId' => $agentId]);
        $list = $this->lists($url, $param);
        foreach ($list['itemList'] as &$val) {
            $val['degree'] = $this->orgAgent($val['orgId'], 'degree');
        }
        int_to_string($list['itemList'], ['insType' => C('INS_TYPE')]);
        return $list['itemList'];
    }

    function orgList2($agentId = 0)
    {
        if (empty($agentId)) {
            $agentId = $this->agentId();
        }
        $list = org_list($agentId);
        int_to_string($list, ['insType' => C('INS_TYPE')]);
        return $list;
    }

    function agent()
    {
        $this->meta_title = "保存代理商信息";
        $auth = $this->getAuth();
        $this->assign('auth', $auth);
        $orgAgent = $this->orgAgent();
        $this->assign('degree', $orgAgent['degree']);
        $this->display('agent');
    }

    function agent2()
    {
        $this->meta_title = "保存代理机构信息";
        $device_type = C('DEVICE_TYPE');
        $org_condition = C('ORG_CONDITION');
        $auth = $this->getAuth();
        $this->assign('org_condition', $org_condition);
        $this->assign('auth', $auth);
        $this->assign('device_type', $device_type);
        $this->display('agent2');
    }

    //添加编辑机构
    function AddOrg()
    {
        $param = $_POST;
        $orgContactList = null;
        foreach ($param as $keys => $val) {
            if (is_array($val) && $keys != 'deviceType' && $keys != 'roleModuleIds' && $keys != 'orgCondition') {
                foreach ($val as $key => $value) {
                    $orgContactList[$key][$keys] = $value;
                    $orgContactList[$key]['contactType'] = $key;
                }
            }
        }
        $imgArr = explode(',', $param['imagePath']);
        $imageList = null;
        foreach ($imgArr as $key => $val) {
            $imageList[$key]['displayName'] = "";
            $imageList[$key]['imagePath'] = $val;
            $imageList[$key]['imageType'] = 0;
            $imageList[$key]['description'] = "";
            $imageList[$key]['imageSeq'] = 0;
        }
        $result = ['orgOrganization' => [
            'orgName' => $param['orgName'],
            'orgCode' => $param['orgCode'],
            'telephone' => $param['telephone'],
            'address' => $param['address'],
            'remark' => $param['remark']
        ],
            'orgContactList' => $orgContactList,
            'imageList' => $imageList,
            'orgDevice' => ['deviceType' => implode(',', $param['deviceType']), 'quantity' => $param['quantity']],
            'permInfo' => ['roleModuleIds' => $param['roleModuleIds']],
            'userInfo' => ['password' => $param['password']]
        ];
        $orgCondition = implode(',', $param['orgCondition']);
        $orgInstitution = [
            'agentId' => $this->agentId()??1,
            'insType' => $param['insType'],
            'district' => $param['district'],
            'orgCondition' => $orgCondition
        ];
        $orgId = I('post.orgId');
        $imgIdArr = explode(',', I('post.imgIdStr'));
        //如果是编辑
        if ($orgId) {
            $result['orgOrganization']['orgId'] = $orgId;
            unset($result['userInfo']);
            unset($orgInstitution['agentId']);
            $orgInstitution['institutionId'] = I('post.institutionId');
            if (!empty($imgIdArr)) {
                foreach ($imgIdArr as $val) {
                    $this->delPicture($val);
                }
            }
        }
        $data = json_encode(['orgInfo' => $result, 'orgInstitution' => $orgInstitution]);
        if ($orgId) {
            $jsonData = http_post_json(C('INTERFACR_API')['ins_update'], $data);
        } else {
            $jsonData = http_post_json(C('INTERFACR_API')['ins_create'], $data);
        }
        if (empty($jsonData)) {
            $this->error('系统错误');
        } elseif ($jsonData['success']) {
            $this->success('保存成功');
        }
    }

    function addAgent()
    {
        $param = $_POST;
        $orgContactList = null;
        foreach ($param as $keys => $val) {
            if (is_array($val) && $keys != 'deviceType' && $keys != 'roleModuleIds') {
                foreach ($val as $key => $value) {
                    $orgContactList[$key][$keys] = $value;
                    $orgContactList[$key]['contactType'] = $key;
                }
            }
        }
        $imgArr = explode(',', $param['imagePath']);
        $imageList = null;
        foreach ($imgArr as $key => $val) {
            $imageList[$key]['displayName'] = '';
            $imageList[$key]['imagePath'] = $val;
            $imageList[$key]['imageType'] = 0;
            $imageList[$key]['description'] = "";
            $imageList[$key]['imageSeq'] = 0;
        }
        $orgInfo = [
            'orgOrganization' =>
                [
                    'orgName' => $param['orgName'],
                    'orgCode' => $param['orgCode'],
                    'telephone' => $param['telephone'],
                    'address' => $param['address'],
                    'remark' => $param['remark']
                ],
            'orgContactList' => $orgContactList,
            'imageList' => $imageList,
            'orgDevice' => [
                'deviceType' => implode(',', $param['deviceType']),
                'quantity' => $param['quantity']
            ],
            'userInfo' => ['password' => $param['password']],
            'permInfo' => ['roleModuleIds' => $param['roleModuleIds']],
        ];
        $orgAgent = [
            'parentId' => $this->agentId() == '' ? 1 : $this->agentId(),
            'degree' => $param['degree'],
            'provinceId' => $param['provinceId'],
            'cityId' => $param['cityId'],
            'countyId' => $param['countyId'],
            'extendFlag' => !$param['extendFlag'] ? 0 : 1
        ];
        $info = ['orgInfo' => $orgInfo, 'orgAgent' => $orgAgent];
        $agentId = I('post.agentId');
        $imgIdArr = explode(',', I('post.imgIdStr'));
        //编辑
        if ($agentId) {
            $info['orgInfo']['orgOrganization']['orgId'] = I('post.orgId');
            $info['orgAgent']['agentId'] = $agentId;
            unset($info['orgInfo']['orgDevice']);
            unset($info['orgAgent']['parentId']);
            //删除照片
            if (!empty($imgIdArr)) {
                foreach ($imgIdArr as $val) {
                    $this->delPicture($val);
                }
            }
            unset($info['orgInfo']['permInfo']);
        }
        $res = json_encode($info);

        //编辑or创建
        if ($agentId) {
            $jsonData = http_post_json(C('INTERFACR_API')['agent_update'], $res);
        } else {
            $jsonData = http_post_json(C('INTERFACR_API')['agent_create'], $res);
        }
        //  exit();
        if ($jsonData['success']) {
            $this->success('保存成功',U('index'));
        } else {
            $this->error('系统错误');
        }
    }

    function agent_detail()
    {
        if (I('get.p')) {
            $this->assign('current_p', I('get.p'));
        }
        if (I('get.p2')) {
            $this->assign('current_p2', I('get.p2'));
        }
        $agentId = I('get.agentId');
        $collocationId = I('get.collocationId');
        if (!empty($collocationId)) {
            $this->assign('collocationId', $collocationId);
        }
        if ($agentId) {
            //编辑
            $this->meta_title = '代理商管理-代理商信息变更';
            $this->assign('agentId', $agentId);
        } else {
            //详情
            $this->meta_title = '代理商管理-代理商详情';
        }
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
        //当前机构
        $this->assign('orgList', $this->orgList($agentId));
        //下级代理商                 agentId
        $agentChild = $this->agentList($agentId);
        $this->assign('agentList', $agentChild);
        //可托管的代理商-同级/父级
        $parentId = $info['parentId'];
        if (!empty($parentId)) {
            $proAgents = $this->getCollacations($parentId, $info['agentId'], I('get.targetId'));
            $this->assign('proAgents', $proAgents);
        }
        //权限
        $moduleList = $manageInfo['orgOrganization']['moduleList'];
        $auth = $this->getAuth();
        $this->assign('moduleList', $moduleList);
        $this->assign('auth', $auth);
        $device_type = C('DEVICE_TYPE');
        $this->assign('device_type',$device_type);
        if(isset($_SESSION['verifyTrue'])){
            $vfyTrue = $_SESSION['verifyTrue'];
        }
        else{
            $vfyTrue = 0;
        }
        $this->assign('verifyTrue',$vfyTrue);
        $this->display();
    }

    //可托管代理商
    function getCollacations($parentId, $agentId, $targetId = null)
    {
        //同级
        $siblingAgents = $this->agentList2($parentId);
        foreach ($siblingAgents as $key => &$value) {
            if ($value['agentId'] == $agentId) {
                unset($siblingAgents[$key]);
            }
            if (is_collocation($value['agentId'])) {
                unset($siblingAgents[$key]);
            }
            if (!empty($targetId)) {
                if ($value['agentId'] == $targetId) {
                    unset($siblingAgents[$key]);
                }
            }
            if ($value['userStatus'] == 1) {
                unset($siblingAgents[$key]);
            }
        }
        sort($siblingAgents);
        //父级
        $parentInfo = get_agent_info($parentId);
        $parentInfo['orgName'] = $parentInfo['orgOrganization']['orgName'];
        $parentInfo['orgCode'] = $parentInfo['orgOrganization']['orgCode'];
        $parentInfo['telephone'] = $parentInfo['orgOrganization']['telephone'];
        $parentInfo['address'] = $parentInfo['orgOrganization']['address'];
        unset($parentInfo['orgOrganization']);
        //获取上级行政区域
        $area = new AreaController();
        $parentInfo['area'] = $area->getFullName($parentInfo['provinceId'], $parentInfo['cityId'], $parentInfo['countyId'], $parentInfo['degree']);
        $arr[] = $parentInfo;
        if (!empty($targetId) && $targetId == $parentInfo['agentId']) {
            $proAgents = $siblingAgents;
        } else {
            $proAgents = array_merge($arr, $siblingAgents);

        }
        return $proAgents;
    }

    //机构托管代理商/机构
    function getInsCollacations($agentId)
    {
        $siblingIns = org_list($agentId);
        int_to_string($siblingIns, ['insType' => C('INS_TYPE')]);
        $agentInfo = get_agent_info($agentId);
        $area = new AreaController();
        $agentInfo['area'] = $area->getFullName($agentInfo['provinceId'], $agentInfo['cityId'], $agentInfo['countyId'], $agentInfo['degree']);
        $res['agent'] = $agentInfo;
        $res['ins'] = $siblingIns;
        return $res;
    }

    //医疗机构详情页
    function agent2_detail()
    {
        $this->meta_title = '代理机构管理-机构详情';
        $insId = I('get.insId');
        $option = get_ins_detail($insId);
        $agentId = $option['agentId'];
        $parentId = get_agent_info($agentId)['parentId'];
        $this->assign('insId', $insId);
        //可托管代理商
        if (!empty($parentId)) {
            $proAgents = $this->getInsCollacations($agentId);
            //dump($proAgents);
            $this->assign('proAgents', $proAgents);
        }
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
        $auth = $this->getAuth();
        $this->assign('org_condition', $org_condition);
        $this->assign('auth', $auth);
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
        $this->display();
    }

    //确认托管代理商
    function confirmCollocation($collocationId)
    {
        $res = confirm_collocation($collocationId);
        if ($res['success']) {
            $this->success('托管成功!');
        } else {
            $this->error('托管失败!');
        }
    }

    //重新托管
    function updateCollocation($collocationId, $targetId)
    {
        $res = update_collocation($collocationId, $targetId);
        if ($res['success']) {
//            $this->success('重新托管成功!', 'index');
            echo 1;exit();
        } else {
//            $this->error('重新托管失败!');
            echo 9;exit();
        }
    }

    //取消托管代理商
    function cancelCollocation($collocationId)
    {
        $res = cancel_collocation($collocationId);
        if ($res['success']) {
            $this->success('取消托管成功!');
        } else {
            $this->error('取消托管失败!');
        }
    }

    //获取权限
    function getAuth()
    {
        $userType = $_SESSION['onethink_admin']['user_auth']['userType'];
        $res = get_auth($userType);
        return $res;
    }

    //发送短信验证码
    function sendVerify()
    {
        if (isset($_POST['mobile'])) {
            $res = send_sms($_POST['mobile']);
            if($res['success']){
                $_SESSION['verify'] = $res['data'];
            }
        }
    }

    function sendMessage()
    {
        $verify = $_POST['verify'];
        if (isset($verify)) {
            if ($verify == $_SESSION['verify']){
                if($_POST['flag'] == 1){
                    $_SESSION['verifyTrue']=$_POST['agentId'];
                }
                elseif ($_POST['flag'] == 2){
                    $_SESSION['verifyTrue']=$_POST['insId'];
                }
                else{
                    echo 2;exit();
                }
                echo 1;
                exit();
            }
            else {
                echo 2;
                exit();
            }
        }

    }

}