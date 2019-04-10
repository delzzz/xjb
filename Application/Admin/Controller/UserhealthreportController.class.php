<?php
namespace Admin\Controller;

class UserhealthreportController extends AdminController
{
    //健康报告列表
    function health_list()
    {
        $this->meta_title = '老人健康档案-健康报告列表';
        $pageNo = I('get.p', 1);
        $name = I('get.name');
        if (empty($name)) {
            $request = '{}';
        } else {
            $request = think_json_encode(['name' => $name]);
        }
        $url = $this->getUrl('userhealth_query') . '?pageNo=' . $pageNo . '&pageSize=' . C('PAGE_SIZE') . '&id=' . $this->__get('orgId') . '&type=' . $this->__get('userType');
        $response = $this->lists($url, $request);
        foreach ($response['itemList'] as $key => &$value) {
            $value['birthDate'] = date('Y-m', $value['birthDate'] / 1000);
        }
        $this->assign('name', $name);
        $this->assign('list', $response['itemList']);
        $this->assign('bType',C('BLOOD_TYPE'));
        $this->assign('sleepValue',C('DATASLEEPVALUE'));
        $this->display();
    }

    //健康报告详情
    function detail()
    {
        $this->meta_title = '老人健康档案-健康报告详情';
        $peopleId = I('get.id');
        $url = $this->getUrl('health_report_info');
        $info = http($url,['peopleId'=>$peopleId],'GET');
        $this->assign('peopleId', $peopleId);
        $this->assign('basic', $info['peopleBasic']);
        $info['healthBasic']['medicalInsurance'] = C('MEDICAL_INSURANCE')[$info['healthBasic']['medicalInsurance']];
        $this->assign('health', $info['healthBasic']);
        $this->assign('org', $info['orgOrganization']);
        $this->assign('contact', $info['contactUrgency']);
        $this->assign('alarm', $info['deviceAlarm']);
        $this->assign('consulting',$info['healthConsultingList'][0]);
        $latestBMI = $this->getLatestBMI($peopleId);
        if($latestBMI['measureTime']!==null){
            $latestBMI['measureTime'] = date('Y年m月d日',$latestBMI['measureTime']/1000);
        }
        $this->assign('latestBMI', $latestBMI);
        $this->assign('bType',C('BLOOD_TYPE'));
        $this->display();
    }


    function getLatestBMI($peopleId = null)
    {
        if (isset($_GET['peopleId'])) {
            $peopleId = $_GET['peopleId'];
            $url = $this->getUrl('bmi_latest');
            $response = http($url, ['peopleId'=>$peopleId], 'GET');
            echo think_json_encode($response);
            exit();
        } else {
            $url = $this->getUrl('bmi_latest');
            $response = http($url, ['peopleId'=>$peopleId], 'GET');
            return $response;
        }
    }

    //获取心率/呼吸数据
    function getHeartOrBreath()
    {
        if (isset($_GET['peopleId'])) {
            $param['peopleId'] = $_GET['peopleId'];
            $param['status'] = $_GET['status'];//1心率2呼吸
            $param['historyData'] = $_GET['historyData'];
            $url = $this->getUrl('heart_or_breath');
            $res = http_post_json($url,json_encode($param));
            echo json_encode($res);
            exit();
        }
    }

    //五分钟获取心率/呼吸数据
    function getFiveHeartOrBreath()
    {
        if (isset($_GET['peopleId'])) {
            //$param['peopleId'] = $_GET['peopleId'];
            $param['peopleId'] = 44;
            $param['status'] = $_GET['status'];//1心率2呼吸
            $url = $this->getUrl('five_heart_or_breath');
            $res = http_post_json($url,json_encode($param));
            echo json_encode($res);
            exit();
        }
    }

    //血氧
    function getBloodOxygen(){
        $url = $this->getUrl('blood_oxygen');
        $param['peopleId'] = $_GET['peopleId'];
        $param['queryType'] = $_GET['queryType'];
        $res =  http($url,$param,'GET');
        echo json_encode($res);
        exit();
    }

    //血压
    function getBloodPressure(){
        $url = $this->getUrl('blood_pressure');
        $param['peopleId'] = $_GET['peopleId'];
        $param['queryType'] = $_GET['queryType'];
        $res =  http($url,$param,'GET');
        echo json_encode($res);
        exit();
    }

    //血糖
    function getBloodGlucose(){
        $url = $this->getUrl('blood_glucose');
        $param['peopleId'] = $_GET['peopleId'];
        $param['queryType'] = $_GET['queryType'];
        $res =  http($url,$param,'GET');
        echo json_encode($res);
        exit();
    }

    //睡眠
    function getSleep(){
        $param['peopleId'] = $_GET['peopleId'];
        $queryType = $_GET['queryType'];
        if($queryType>0){
            $url = $this->getUrl('sleep_history');
            $param['historyData'] = $queryType;
        }
        else{
            $url = $this->getUrl('sleep_yesterday');
       }
        $res = http_post_json($url,json_encode($param));
        echo json_encode($res);
        exit();
    }

}