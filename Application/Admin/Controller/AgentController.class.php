<?php
namespace Admin\Controller;

class AgentController extends AdminController
{
    function index()
    {
        $orgAgent = $this->orgAgent();
        dump($orgAgent);
        //$orgId = $orgAgent['orgId'];
        //$param['orgName']=$this->orgName();
        //$param['parentId']=$orgAgent[''];
        //$param['degree']=1;
        $agents = http('http://192.168.1.250:8080/service/org/agent/query?pageNo=1&pageSize=1',$param);
        dump($agents);
        $this->display();
    }

    function orgList()
    {

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
        $orgInstitution = ['agentId' => $this->orgAgent('agentId'),
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
        $this->display();
    }
}