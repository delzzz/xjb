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
        $orgInstitution = ['agentId' => $this->org_agent('agentId'),
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
}