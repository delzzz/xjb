<?php
namespace Admin\Controller;

class UserbasicfileController extends AdminController
{
    function basicfile()
    {
        $pageNo = I('get.p', 1);
        $name = I('get.name');
        if (empty($name)) {
            $request = "{}";
        } else {
            $request = think_json_encode(['name' => $name]);
        }
        $url = $this->getUrl('people_query') . '?pageNo=' . $pageNo . '&pageSize=' . C('PAGE_SIZE');
        $response = $this->lists($url, $request);
        int_to_string($response['itemList'], ['gender' => [0 => '女', 1 => '男'], 'livingStatus' => C('LIVINGSTATUS'), 'economy' => C('ECONOMY')]);
        foreach ($response['itemList'] as &$value) {
            if (!empty($value['deviceIdentifiers'])) {
                foreach ($value['deviceIdentifiers'] as $val) {
                    $value['device_str'] .= $val . ';';
                }
            } else {
                $value['device_str'] = '';
            }

        }
        $this->assign('name', $name);
        $this->assign('list', $response['itemList']);
        $this->meta_title = "老人基础档案";
        $this->display();
    }

    function edit()
    {
        $this->display();
    }

    function write()
    {
        $param = $_POST;
        $peopleBasic = [
            'peopleIdentifier' => $param['peopleIdentifier'],
            'orgId' => $this->orgId(),
            'name' => $param['pel_name'],
            'age' => $param['age'],
            'gender' => $param['gender'],
            'birthDate' => '',
            'idNumber' => $param['idNumber'],
            'telephone' => $param['tele_phone'],
            'nativePlace' => $param['nativePlace'],
            'ethnicity' => $param['ethnicity'],
            'education' => $param['education'],
            'economy' => $param['economy'],
            'livingStatus' => $param['livingStatus'],
            'healthStatus' => $param['healthStatus'],
            'adress' => $param['pel_adress']
        ];
        $hobby = '';
        if (!empty($param['hobby'])) {
            foreach ($param['hobby'] as $value) {
                $hobby = $value . ';';
            }
            $hobby = substr($hobby, 1, strlen($hobby) - 1);
        }
        $peopleDetail = [
            'hobby' => $hobby,
            'hobbyOtherDesc' => $param['hobbyOtherDesc'],
            'remark' => '',
        ];
        $impage = [
            'displayName' => '',
            'imagePath' => $param['imagePath'],
            "imageType" => 1,
            "sourceId" => 1,
            "sourceType" => 3,
            "description" => "",
            "imageSeq" => 1
        ];
        $peopleRelativeList = [];
        if (!empty($param['name'][0])) {
            foreach ($param['name'] as $key => $value) {
                $peopleRelativeList[$key]['name'] = $value;
                $peopleRelativeList[$key]['telephone'] = $param['telephone'][$key];
                $peopleRelativeList[$key]['relation'] = $param['relation'][$key];
                $peopleRelativeList[$key]['address'] = $param['address'][$key];
            }
        }
        $peopleDeviceList = [];
        if (!empty($param['deviceName'][0])) {
            foreach ($param['deviceName'] as $key => $value) {
                $peopleDeviceList[$key]['deviceName'] = $value;
                $peopleDeviceList[$key]['deviceIdentifier'] = $param['deviceIdentifier'][$key];
                $peopleDeviceList[$key]['deviceInstallDate'] = $param['deviceInstallDate'][$key];
            }
        }
        $data = [
            'peopleBasic' => $peopleBasic,
            'peopleDetail' => $peopleDetail,
            'impage' => $impage,
            'peopleRelativeList' => $peopleRelativeList,
            'peopleDeviceList' => $peopleDeviceList
        ];
        $request = think_json_encode($data);
        $url = $this->getUrl('people_save_edit');
        $response = http_post_json($url, $request);
        if ($response) {
            $this->success("保存成功");
        } else {
            $this->error("保存失败");
        }
    }

    function newadd()
    {
        $this->meta_title = "老人健康档案信息";
        $ethnicity = C('ETHNICITY');
        $education = C('EDUCATION');
        $economy = C('ECONOMY');
        $livingStatus = C('LIVINGSTATUS');
        $healthStatus = C('HEALTHSTATUS');
        $hobby = C('HOBBY');
        $this->assign('ethnicity', $ethnicity);
        $this->assign('education', $education);
        $this->assign('economy', $economy);
        $this->assign('livingStatus', $livingStatus);
        $this->assign('healthStatus', $healthStatus);
        $peopleId = I('get.peopleId');
        if ($peopleId) {
          
        }
        $this->assign('hobby', $hobby);
        $this->display();
    }
}