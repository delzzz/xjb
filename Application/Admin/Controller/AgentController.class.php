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
            'sysUserInfo' => ['password' => $param['sysUserInfo']],
            'orgInstitution' => ['agentId' => $this->org_agent('agentId'),
                'insType' => $param['insType'],
                'district' => $param['district']]
        ];
        $data = json_encode(['orgInfo' => $result]);
        $jsonData = http_post_json(C('INTERFACR_API')['ins_create'], $data);
        print_r($jsonData);
        die();
    }
    function addAgent(){
        $param = $_POST;
        $orgContactList = null;
        foreach ($param as $keys => $val) {
            if (is_array($val)) {
                foreach ($val as $key => $value) {
                    $orgContactList[$key][$keys] = $value;
                    $orgContactList[$key]['contactType']=$key;
                }
            }
        }
        $imgArr = explode(',', $param['imagePath']);
        $imageList = null;
        foreach ($imgArr as $key => $val) {
            $imageList[$key]['displayName'] = $val;
            $imageList[$key]['imagePath'] = $val;
            $imageList[$key]['imagePath'] = 0;
            $imageList[$key]['description'] = "";
            $imageList[$key]['imageSeq'] = 0;
        }
        $orgInfo = [
            'orgOrganization'=>
            [
                'orgName'=>$param['orgName'],
                'orgCode'=>$param['orgCode'],
                'telephone'=>$param['telephone'],
                'address'=>$param['address'],
                'remark'=>$param['remark']
            ],
            'orgContactList'=>$orgContactList,
            'imageList'=>$imageList,
            'orgDevice'=>[
                'deviceType'=>implode(',',$param['deviceType']),
                'quantity'=>$param['quantity']
            ],
            'sysUserInfo' => ['password' => $param['sysUserInfo']]
        ];
        $orgAgent = [
            'parentId'=>1,
            'degree'=>$param['degree'],
            'provinceId'=>$param['provinceId'],
            'cityId'=>$param['cityId'],
            'countyId'=>$param['countyId'],
            'extendFlag'=>!$param['extendFlag']?0:1
        ];
        $info = ['orgInfo'=>$orgInfo,'orgAgent'=>$orgAgent];
        $arr = C('INTERFACR_API');
        $res = json_encode($info);
        var_dump($info);
        $result = http($arr['agent_create'],substr($res,1,strlen($res)-1),post);
        var_dump($result);
    }
}