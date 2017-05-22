<?php
namespace Admin\Controller;

class AgentController extends AdminController
{
    function index()
    {
        $this->meta_title = '代理商管理';
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
                    $value['child'][$k]['children'] = agent_list($v['agentId']);
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
        $this->assign('agentList', $agentList);
        $this->assign('orgList', $this->orgList());
        $this->display();
    }


    function orgList()
    {
        $pageNo = I('get.p', 1);
        $url = C('INTERFACR_API')['query_org'] . '?pageNo=' . $pageNo . '&pageSize=' . C('PAGE_SIZE');
        $param = think_json_encode(['agentId' => $this->agentId()]);
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
            $imageList[$key]['displayName'] = $val;
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

        $orgInstitution = ['agentId' => $this->agentId(),
            'insType' => $param['insType'],
            'district' => $param['district']];
        $data = json_encode(['orgInfo' => $result, 'orgInstitution' => $orgInstitution]);
        $jsonData = http_post_json(C('INTERFACR_API')['ins_create'], $data);
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


        $res = json_encode($info);
        $jsonData = http_post_json(C('INTERFACR_API')['agent_create'], $res);
        var_dump($jsonData);
    }

    //代理商详情页
    function agent_detail()
    {
        $this->meta_title = '代理商管理-代理商详情';
        $this->display();
    }

    //医疗机构详情页
    function agent2_detail()
    {
        $this->meta_title = '代理机构管理-机构详情';
        $insId = I('get.insId');
        $url = $this->getUrl('get_org_detail') . $insId;
        $option = http($url, null, 'GET');
        $this->assign('info', $option);
        $this->assign('orgInfo', $option['orgOrganization']);
        $this->assign('contactList', $option['orgOrganization']['contactList']);
        $this->assign('imgList', $option['orgOrganization']['imageList']);
        $this->assign('orgDevice', $option['orgDevice']);
        $this->display();
    }
}