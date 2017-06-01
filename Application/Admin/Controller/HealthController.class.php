<?php
namespace Admin\Controller;

class HealthController extends AdminController
{
    function index()
    {
        $this->meta_title = "健康监控";
        $pageNo = I('get.p', 1);
        $name = I('get.name');
        $param = think_json_encode(['name' => $name]);
        if (empty($name)) {
            $param = "{}";
        }
        $url = $this->getUrl('health_query') . '?pageNo=' . $pageNo . '&pageSize=' . C('PAGE_SIZE');
        $list = $this->lists($url, $param);
        foreach ($list['itemList'] as &$val) {
            foreach ($val['deviceIdentifiers'] as $value) {
                $val['device_str'] .= $value . ';';
            }
        }
        $this->assign('list', $list['itemList']);
        $this->display();
    }

    //历史数据
    function history()
    {
        $peopleId = I('get.peopleId');
        $url = $this->getUrl('history') . $peopleId;
        $response = http($url, null, 'GET');
        print_r($response);
    }

    function add()
    {
        $this->display();
    }

    //详情
    function detail()
    {
        $rid = I('get.rid');
        if($rid){
            $info = $this->medication_detail($rid);
            //dump($info);
            $this->assign('medicationInfo',$info);
            $this->assign('remind',$info['medicationRemindVo']);
            $this->assign('history',$info['medicationRemindHistoryVoList']);
            //后台端0/坐席端1
            $this->assign('flag',1);
        }
        $this->display();
    }

    //后台-用药提醒页面
    function medication()
    {
        $medicationList = $this->medication_list(I('get.status'));
        $this->assign('medicationList',$medicationList);
        //dump($medicationList);

        $this->display();
    }

    //坐席-用药提醒页面
    function zuoxi_medication(){
        $medication_lists = $this->medication_list(I('get.status'));
        $current_hour = date('H:i');
        $c_arr = explode(':',$current_hour);
        $c_hour = implode('',$c_arr);
        //下次用药提醒
        foreach ($medication_lists as $key=>&$value){
            //用药提醒关闭或者过期下次服药时间为空
            if($value['status'] == 1 || $value['endDate']/1000<=time()){
                $value['nextTime'] = '-';
            }
            else{
                foreach ($value['triggerTimes'] as $k=>$v){
                    $v_arr = explode(':',$v);
                    $new_v = implode('',$v_arr);
                   if($new_v > $c_hour){
                       $value['nextTime'] = $v;
                       break;
                   }
                   else{
                       $value['nextTime'] = $value['triggerTimes'][0];
                   }

                }
            }
        }
        $this->assign('medicationList',$medication_lists);
        $this->display();
    }

    //用药提醒列表
    function medication_list($status){
        $pageNo = I('get.p', 1);
        $pageSize = C('PAGE_SIZE');
        if($status==0){
            $status=0;
        }
        elseif($status == -1 || $status == ''){
            //所有
            $status = null;
        }
//        elseif($status == 1){
//            //进行中
//            $status = 0;
//        }
//        elseif ($status == 2){
//            //已关闭
//            $status = 1;
//        }
        //$url = C('INTERFACR_API')['medication_list'];
        $url = 'http://192.168.1.250:8080/service/medication/remind/get/page?pageNo=' . $pageNo . '&pageSize=' .$pageSize ;
        $param = think_json_encode(['status' => $status ]);
        $lists = $this->lists($url,$param);
        return $lists['itemList'];
    }

    //获取详情
    function medication_detail($rid){
        $url = 'http://192.168.1.250:8080/service/medication/remind/get/detail/'.$rid;
        $info = http($url,null,'get');
        return $info;
    }

    //关闭提醒
    function closeRemind(){
        if(isset($_POST['remindId'])){
            $rid =  $_POST['remindId'];
            $url = 'http://192.168.1.250:8080/service/medication/remind/close/'.$rid;
            $data = json_encode(['closerId' => $_POST['closerId'], 'closeReason' => $_POST['closeReason']]);
            $info = http_post_json($url,$data);
            //dump($info);
            //die();
            if($info['success']){
                echo 1;
                exit();
            }
            else{
                echo 2;
                exit();
            }
        }
    }

    //坐席-添加用药提醒页面
    function add_reminder(){
        //根据peopleId查询老人基础档案
        if(isset($_POST['peopleId'])){
            $info = $this->getInfo($_POST['peopleId']);
            $this->ajaxReturn($info);
            exit();
        }
//        if(isset($_POST['name'])){
//            $oldList = $this->getInfoList($_POST['name']);
//            exit();
//        }
//        else{
            $oldList = $this->getInfoList();
        //dump($oldList);
//        }
        $this->assign('oldList',$oldList);
        $this->display();
    }

    //老人信息列表
    function getInfoList($name=null){
        $url = 'http://192.168.1.250:8080/service/people/get/basic/page?pageNo=1&pageSize=100';
        $param['name'] = $name;
        $list = http_post_json($url,json_encode($param));
        return $list['itemList'];
    }

    //查询老人基础档案
    function getInfo($peopleId){
        $url = 'http://192.168.1.250:8080/service/people/get/detail/'.$peopleId;
        $res = http($url,null,'get');
        return $res['peopleBasic'];
    }

    //添加老人用药提醒
    function add_call(){
        if(isset($_POST['drugName'])){
            //添加者id adderId
            foreach ($_POST['drugName'] as $key=>$value){
                $param['remindId'] = null;
                $param['peopleId'] = $_POST['pid'];
                $param['adderId'] = UID;
                $param['startDate'] = $_POST['startDate'][$key];
                $param['endDate'] = $_POST['endDate'][$key];
                $param['drugName'] = $_POST['drugName'][$key];
                $param['dose'] = $_POST['dose'][$key];
                $param['doseUnit'] = $_POST['doseUnit'][$key];
                $param['remark'] = $_POST['remark'][$key];
                $trigger_arr = explode(';',$_POST['triggerTimes'][$key]);
                $param['triggerTimes'] = json_encode(array_filter($trigger_arr));
                $url = 'http://192.168.1.250:8080/service/medication/remind/create';
                $res = http_post_json($url,json_encode($param));
                var_dump(json_encode($param));
                var_dump($res);
                exit();
                if($res['success']){
                    $this->success('添加成功');
                }
                else{
                    $this->error('添加失败');
                }
            }
        }
    }
}