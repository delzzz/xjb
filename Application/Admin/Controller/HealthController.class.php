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

    function detail()
    {
        $this->display();
    }

    function medication()
    {
        $this->display();
    }
}