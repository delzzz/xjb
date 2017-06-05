<?php
namespace Admin\Controller;

class WarningController extends AdminController
{
    function warning_detail()
    {
        $alarmId = I('get.alarmId');
        $url = $this->getUrl('warning_detail') . $alarmId;
        $response = http($url, null, 'GET');
        $warning_status = C('WARNING_STATUS');
        $living_status = C('LIVINGSTATUS');
        $health_status = C('HEALTHSTATUS');
        $response['alarmType_text'] = $warning_status[$response['alarmType']];
        $response['liveStatus_text'] = $living_status[$response['livingStatus']];
        $response['healthStatus_text'] = $health_status[$response['healthStatus']];
//        print_r($response);die();
        $this->assign('data', $response);
        $this->meta_title = "设备报警详情";
        $this->display();
    }

    function warning_history()
    {
        $this->meta_title = "历史报警";
        $pageNo = I('get.p', 1);
        $url = $this->getUrl('warning_list') . '?pageNo=' . $pageNo . '&pageSize=' . C('PAGE_SIZE');
        $param = "{}";
        $list = $this->lists($url, $param);
        $warning_status = C('WARNING_STATUS');
        int_to_string($list['itemList'], ['gender' => ['1' => '男', 0 => '女'], 'alarmType' => $warning_status]);
        $this->assign('warning_status', $warning_status);
        $this->assign('list', $list['itemList']);
        $this->display();
    }
}