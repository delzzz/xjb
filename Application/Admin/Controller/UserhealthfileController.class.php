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
        $peopleId = I('get.id');
        $url = 'http://192.168.1.250:8080/service/health/get/detail/'.$peopleId;
        $info = http($url,null,'get');
        $this->assign('info',$info);
        dump($info);
        $this->display();
    }



}