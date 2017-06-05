<?php
namespace Admin\Controller;

class UserhealthfileController extends AdminController
{
    //健康档案列表
    function health_list(){
        $this->meta_title = '老人健康档案-健康档案列表';
        $pageNo = I('get.p', 1);
        $name = I('get.name');
        if (empty($name)) {
            $request = "{}";
        } else {
            $request = think_json_encode(['name' => $name]);
        }
        $url ='http://192.168.1.250:8080/service/health/get/page'.'?pageNo='.$pageNo. '&pageSize=' . C('PAGE_SIZE');
        $response = $this->lists($url, $request);
        foreach ($response['itemList'] as $key=>&$value){
           $value['birthDate'] = date('Y-m',$value['birthDate']/1000);
        }
        //dump($response['itemList']);
        $this->assign('name', $name);
        $this->assign('list', $response['itemList']);
        $this->display();
    }

    //健康档案详情
    function edit(){
        $this->meta_title = '老人健康档案-健康档案详情';
        $peopleId = I('get.id');
        $url = 'http://192.168.1.250:8080/service/health/get/detail/'.$peopleId;
        $info = http($url,null,'get');
        //dump($info);
        $historyBreathe = $this->historyBreathe($info['healthBasic']['healthId']);
        $historyPressure = $this->historyPressure($info['healthBasic']['healthId']);
        $this->assign('info',$info);
        $this->assign('basic',$info['healthBasic']);
        $this->assign('consultings',$info['consultings']);
        $this->assign('breathe',$info['breathe']);
        $this->assign('pressure',$info['bloodPressure']);
        dump($info['bloodPressure']);
        $this->assign('bType',C('BLOOD_TYPE'));
        $this->assign('medicalInsurance',C('MEDICAL_INSURANCE'));
        $this->assign('dataSrc',C('DATASRC'));
        $this->assign('dataSleepValue',C('DATASLEEPVALUE'));
        $this->assign('consultRecorder',UID);
        $this->assign('historyBreathe',$historyBreathe);
        $this->assign('historyPressure',$historyPressure);
        $this->display();
    }

    //编辑健康档案
    function editFile(){
        if(isset($_POST['peopleId'])){
            $param = $_POST;
            $url = 'http://192.168.1.250:8080/service/health/saveOrUpdate/basic';
            $res = http_post_json($url,json_encode($param));
            if($res['success']){
                $this->success('保存成功！');
            }
            else{
                $this->error('保存失败！');
            }
        }
    }

    //新增咨询
    function addConsult(){
        if(isset($_POST['healthId'])){
            $param = $_POST;
            $url='http://192.168.1.250:8080/service/health/consult/saveOrUpdate';
            $param['consultingId'] = null;
            //dump($param);exit();
            $res = http_post_json($url,json_encode($param));
            if($res['success']){
                echo 1;exit();
            }
            else{
                echo 2;exit();
            }
        }
    }

    //新增呼吸心率
    function addBreathe(){
        if(isset($_POST['healthId'])){
            $param = $_POST;
            $param['entryUserId']=UID;
            $param['entryTime']=date('Y-m-d');
            $param['measureCondition']=$param['dataSrc'];
            if(empty($param['breatheId'])){
                $param['breatheId'] = null;
            }
            $url='http://192.168.1.250:8080/service/health/breath/saveOrUpdate';
            $res = http_post_json($url,json_encode($param));
            if($res['success']){
                echo 1;
                exit();
            }
            else{
                echo 2;
                exit();
            }
        }
    }

    //修改呼吸心率
    function editBreathe(){
        if(isset($_POST['breatheId'])){
            $param = $_POST;
            $param['entryUserId']=UID;
            $param['entryTime']=date('Y-m-d');
            $param['measureCondition']=$param['dataSrc'];
            $url='http://192.168.1.250:8080/service/health/breath/saveOrUpdate';
            $res = http_post_json($url,json_encode($param));
            if($res['success']){
                echo 1;
                exit();
            }
            else{
                echo 0;
                exit();
            }
        }
    }

    //删除呼吸心率
    function delBreathe(){
        $id = I('get.id');
        if($id){
            $url='http://192.168.1.250:8080/service/health/breath/delete/'.$id;
            $res = http($url,null,'get');
            if($res['success']){
                $this->success('删除成功！');
            }
            else{
                $this->error('删除失败!');
            }
        }
    }

    //呼吸心率历史记录
    function historyBreathe($id){
        $url='http://192.168.1.250:8080/service/health/breath/get/all/'.$id;
        $res = http($url,null,'get');
        return $res;
    }

    //新增血压
    function addPressure(){
        if(isset($_POST['dataInValue'])){
            //echo 111; exit();
            $param = $_POST;
            if(empty($param['bloodPressureId'])){
                $param['bloodPressureId'] = null;
            }
            $param['healthId'] = $param['healthId2'];
            $param['entryUserId']=UID;
            $param['entryTime']=date('Y-m-d');
            $param['measureCondition']=$param['dataSrc'];
            unset($param['healthId2']);
            //dump($param);exit();
            $url = 'http://192.168.1.250:8080/service/health/bloodPressure/saveOrUpdate';
            $res = http_post_json($url,json_encode($param));
            if($res['success']){
                $this->success('保存成功!');
            }
            else{
                $this->error('保存失败！');
            }
        }

    }
    //血压历史记录
    function historyPressure($id){
        $url='http://192.168.1.250:8080/service/health/bloodPressure/get/all/'.$id;
        $res = http($url,null,'get');
        return $res;
    }




}