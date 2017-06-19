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
        $url =$this->getUrl('userhealth_query').'?pageNo='.$pageNo. '&pageSize=' . C('PAGE_SIZE');
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
        $url = $this->getUrl('userhealth_detail').$peopleId;
        $info = http($url,null,'get');
        $healthId = $info['healthBasic']['healthId'];
        $this->assign('currentTime',date('Y-m-d'));
        $historyBreathe = $this->historyBreathe($healthId);
        $historyPressure = $this->historyPressure($healthId);
        $historyGlucose = $this->historyGlucose($healthId);
        $historyOxygen = $this->historyOxygen($healthId);
        $historyBmi = $this->historyBmi($healthId);
        $this->assign('peopleId',$peopleId);
        $this->assign('info',$info);
        $this->assign('basic',$info['healthBasic']);
        $this->assign('consultings',$info['consultings']);
        $this->assign('breathe',$info['breathe']);
        $this->assign('pressure',$info['bloodPressure']);
        $this->assign('glucose',$info['bloodGlucose']);
        $this->assign('oxygen',$info['bloodOxygen']);
        $this->assign('bmi',$info['bmi']);
        $this->assign('bType',C('BLOOD_TYPE'));
        $this->assign('medicalInsurance',C('MEDICAL_INSURANCE'));
        $this->assign('dataSrc',C('DATASRC'));
        $this->assign('dataSleepValue',C('DATASLEEPVALUE'));
        $this->assign('mCondition',C('MEASURE_CONDITION'));
        $this->assign('consultRecorder',$_SESSION['onethink_admin']['user_auth']['userName']);
        $this->assign('historyBreathe',$historyBreathe);
        $this->assign('historyPressure',$historyPressure);
        $this->assign('historyGlucose',$historyGlucose);
        $this->assign('historyOxygen',$historyOxygen);
        $this->assign('historyBmi',$historyBmi);
        $this->display();
    }

    //编辑健康档案
    function editFile(){
        if(isset($_POST['peopleId'])){
            $param = $_POST;
            if(empty($param['peopleId'])){
                $param['peopleId']=null;
            }
            $param['entryUserId']=UID;
            $url = $this->getUrl('userhealth_edit');
            $res = http_post_json($url,json_encode($param));
            //dump($res);
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
            $url=$this->getUrl('consultant_add');
            $param['consultingId'] = null;
            $res = http_post_json($url,json_encode($param));
            if($res['success']){
                $this->success('添加咨询成功!');
            }
            else{
                $this->error('添加咨询失败!');
            }
        }
    }

    //新增修改呼吸心率
    function addBreathe(){
        if(isset($_POST['dataBreathValue'])){
            $param = $_POST;
            $param['entryUserId']=UID;
            $param['entryTime']=date('Y-m-d');
            $param['measureCondition']=$param['dataSrc'];
            if(empty($param['breatheId'])){
                $param['breatheId'] = null;
            }
            $url=$this->getUrl('breathe_add');
            $res = http_post_json($url,json_encode($param));
            if($res['success']){
                $this->success('保存成功!');
            }
            else{
                $this->error('保存失败！');
            }
        }
    }

    //呼吸心率历史记录
    function historyBreathe($id){
        $url=$this->getUrl('breathe_history').$id;
        $res = http($url,null,'get');
        return $res;
    }

    //新增修改血压
    function addPressure(){
        if(isset($_POST['dataInValue'])){
            $param = $_POST;
            if(empty($param['bloodPressureId'])){
                $param['bloodPressureId'] = null;
            }
            $param['entryUserId']=UID;
            $param['entryTime']=date('Y-m-d');
            $param['measureCondition']=$param['dataSrc'];
            $url = $this->getUrl('pressure_add');
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
        $url=$this->getUrl('pressure_history').$id;
        $res = http($url,null,'get');
        foreach ($res as $key=>&$value){
            if($value['dataInValue']<90||$value['dataOutValue']<60){
                $value['condition'] = '偏低';
            }
            elseif ($value['dataInValue']>140||$value['dataOutValue']>90){
                $value['condition'] = '偏高';
            }
            else{
                $value['condition'] = '正常';
            }

        }
        return $res;
    }

    //添加修改血糖
    function addGlucose(){
        if(isset($_POST['dataValue'])){
            $param = $_POST;
            if(empty($param['bloodGlucoseId'])){
                $param['bloodGlucoseId'] = null;
            }
            $param['entryUserId']=UID;
            $param['entryTime']=date('Y-m-d');
            $url = $this->getUrl('glucose_add');
            $res = http_post_json($url,json_encode($param));
            if($res['success']){
                $this->success('保存成功!');
            }
            else{
                $this->error('保存失败！');
            }
        }
    }

    //血糖历史记录
    function historyGlucose($id){
        $url=$this->getUrl('glucose_hisotory').$id;
        $res = http($url,null,'get');
        foreach ($res as $key=>&$value){
            if($value['dataValue']<3.6){
                $value['condition'] = '偏低';
            }
            elseif ($value['dataValue']>11.1 || $value['measureCondition']==0 && $value['dataValue']>6.1 || $value['measureCondition']==1 && $value['dataValue']>7.9){
                $value['condition'] = '偏高';
            }
            else{
                $value['condition'] = '正常';
            }
            $value['measureCondition']=$value['measureCondition']==1?'餐后两小时':'餐前';

        }
        return $res;
    }

    //添加修改血氧
    function addOxygen(){
        if(isset($_POST['dataValue'])){
            $param = $_POST;
            if(empty($param['bloodOxygenId'])){
                $param['bloodOxygenId'] = null;
            }
            $param['entryUserId']=UID;
            $param['entryTime']=date('Y-m-d');
            $param['measureCondition']=$param['dataSrc'];
            $url = $this->getUrl('oxygen_add');
            $res = http_post_json($url,json_encode($param));
            if($res['success']){
                $this->success('保存成功!');
            }
            else{
                $this->error('保存失败！');
            }
        }
    }

    //血氧历史
    function historyOxygen($id){
        $url=$this->getUrl('oxygen_history').$id;
        $res = http($url,null,'get');
        return $res;
    }

    //删除血氧
    function delLatest(){
        $id = I('get.id');
        $type = I('get.type');
        if($id){
            if($type==1){
                //呼吸
                $url=$this->getUrl('breathe_del').$id;
            }
            elseif($type==2){
                //血压
                $url=$this->getUrl('pressure_del').$id;
            }
            elseif($type==3){
                //血糖
                $url=$this->getUrl('glucose_del').$id;
            }
            elseif($type==4){
                //血氧
                $url=$this->getUrl('oxygen_del').$id;
            }
            elseif ($type==5){
                //bmi
                $url=$this->getUrl('bmi_del').$id;
            }
            $res = http($url,null,'get');
            if($res['success']){
                echo '删除成功!';
                exit();
            }
            else{
                echo '删除失败!';
                exit();
            }
        }
    }
    //添加修改bmi
    function addBmi(){
        if(isset($_POST['dataHeightValue'])){
            $param = $_POST;
            if(empty($param['bmiId'])){
                $param['bmiId'] = null;
            }
            $param['entryUserId']=UID;
            $param['entryTime']=date('Y-m-d');
            $param['measureCondition']=$param['dataSrc'];
            $url = $this->getUrl('bmi_add');
            $res = http_post_json($url,json_encode($param));
            //dump($res);exit();
            if($res['success']){
                $this->success('保存成功!');
            }
            else{
                $this->error('保存失败！');
            }
        }
    }
    //bmi历史
    function historyBmi($id){
        $url=$this->getUrl('bmi_history').$id;
        $res = http($url,null,'get');
        return $res;
    }
}
