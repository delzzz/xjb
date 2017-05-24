<?php
namespace Admin\Controller;

class AgentController extends AdminController
{
    function index()
    {
        $this->meta_title = '代理商管理';


        $this->assign('agentList', $this->agentList());
        $this->assign('orgList', $this->orgList());

        $this->display();
    }




    function agentList()
    {
        $info = $this->orgAgent();
        $agentList = agent_list($info['agentId']);

        foreach ($agentList as $key => &$value) {
            //date类型去除后面000
            $value['createTime'] = substr($value['createTime'], 0, strlen($value['createTime']) - 3);
            $value['updateTime'] = substr($value['updateTime'], 0, strlen($value['updateTime']) - 3);
            if (agent_list($value['agentId']) != null) {
                $value['child'] = agent_list($value['agentId']);
            }


            if ($value['child'] != null) {
                foreach ($value['child'] as $k => &$v) {
                    //date类型去除后面000
                    $v['createTime'] = substr($v['createTime'], 0, strlen($v['createTime']) - 3);
                    $v['updateTime'] = substr($v['updateTime'], 0, strlen($v['updateTime']) - 3);


                    if (agent_list($v['agentId']) != null) {
                        $value['child'][$k]['children'] = agent_list($v['agentId']);
                    }
                    if ($v['children'] != null) {
                        foreach ($v['children'] as $kk => &$vv) {
                            //date类型去除后面000
                            $vv['createTime'] = substr($vv['createTime'], 0, strlen($vv['createTime']) - 3);
                            $vv['updateTime'] = substr($vv['updateTime'], 0, strlen($vv['updateTime']) - 3);
                        }
                    }
                }
            }
        }
        return $agentList;
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

    function agent()
    {
        $this->meta_title = "保存代理商信息";
        $this->display('agent');
    }

    function agent2()
    {
        $this->meta_title = "保存代理机构信息";
        $this->display('agent2');
    }

    //添加编辑机构
    function AddOrg()
    {
        $param = $_POST;
        $orgContactList = null;
        foreach ($param as $keys => $val) {
            if (is_array($val)) {
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
            'orgDevice' => ['deviceType' => "0,1", 'quantity' => 100],
            'sysUserInfo' => ['password' => $param['password']]
        ];
        $orgInstitution = [
            'agentId' => $this->agentId(),
            'insType' => $param['insType'],
            'district' => $param['district']
        ];
        $orgId = I('post.orgId');
        $imgIdArr = explode(',', I('post.imgIdStr'));
        //如果是编辑
        if ($orgId) {
            $result['orgOrganization']['orgId'] = $orgId;
            unset($result['sysUserInfo']);
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
            if (is_array($val) && $keys != 'deviceType') {
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
            'sysUserInfo' => ['password' => $param['password']]
        ];
        $orgAgent = [
            'parentId' => 1,
            'degree' => 0,
            'provinceId' => 0,
            'cityId' => 0,
            'countyId' => 0,
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
        }

        $res = json_encode($info);

        //编辑or创建
        if ($agentId) {


            $jsonData = http_post_json(C('INTERFACR_API')['agent_update'], $res);
        } else {
            $jsonData = http_post_json(C('INTERFACR_API')['agent_create'], $res);
        }
        if (empty($jsonData)) {
            $this->error('系统错误');
        } elseif ($jsonData['success']) {
            $this->success('保存成功');
        }
    }

    //托管代理商
    function depositAgent(){
        $param = $_POST;
        //托管
        //dump($param);
        if(!empty($param['targetId'])){
            $res = deposit_agent($param['agentId'],$param['targetId']);
            if($res['success']){
                echo 111;
                exit();
            }
        }
    }

    function agent_detail()
    {
        $_GET['agentId'] = 1;


        if (I('get.agentId')) {
            if (I('get.editId')) {
                //编辑
                $this->meta_title = '代理商管理-代理商信息变更';


                $this->assign('editFlag', 1);
            } else {
                //详情
                $this->meta_title = '代理商管理-代理商详情';

        }
            //$agentId = $this->agentId();
            $info = get_agent_info(5);


            $this->assign('info', $info);

            dump($info);
            $agentId = 5;
            $agentDetail = $this->getUrl('get_agent_detail');


            $manageInfo = http($agentDetail . $agentId, null, 'get');
            $this->assign('manageInfo', $manageInfo);
            //dump($manageInfo);
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
            $orgList = org_list($agentId);

            int_to_string($orgList, ['insType' => C('INS_TYPE')]);

            //下级代理商                 agentId
            $agentList = $this->agentList(5);


            $this->assign('orgList', $orgList);
            $this->assign('agentList', $agentList);
            //dump($agentList);
            //可托管的代理商-同级/父级
            $parentId = $info['parentId'];
            if(!empty($parentId)){
                //同级
                $siblingAgents = $this->agentList($parentId);
                foreach ($siblingAgents as $key=>&$value){
                    if($value['agentId'] == $info['agentId']){
                        unset($siblingAgents[$key]);
                    }
                    if($value['child'] != null){
                        unset($value['child']);
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
                $arr[]=$parentInfo;
                $proAgents = array_merge($arr,$siblingAgents);

            }
            else{
            }
            $this->assign('proAgents',$proAgents);
            //dump($proAgents);
            $this->display();
        }
    }

    //医疗机构详情页
    function agent2_detail()
    {
        $this->meta_title = '代理机构管理-机构详情';
        $insId = I('get.insId');
        $url = $this->getUrl('get_org_detail') . $insId;
        $option = http($url, null, 'GET');
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
        $this->assign('info', $option);
        $this->assign('orgInfo', $option['orgOrganization']);
        $this->assign('contactList', $option['orgOrganization']['contactList']);
        $this->assign('imgList', $imgList);
        $this->assign('imgPathStr', $imgPath);
        $this->assign('imgIdStr', $imgIdStr);
        $this->assign('orgDevice', $option['orgDevice']);
        $this->display();
    }
}