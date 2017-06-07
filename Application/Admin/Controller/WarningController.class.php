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
        $processList = $response['processList'];
        int_to_string($processList, ['processMode' => C('PROCESS_MODE'), 'processResult' => C('PROCESS_RESULT')]);

        $pageNo = I('get.p2', 1);
        $pageSize = C('PAGE_SIZE');
        $request = '{}';
        $base_url = $this->getUrl('warning_history') . '?pageNo=' . $pageNo . '&pageSize=' . $pageSize;
        $history_list = $this->lists($base_url, $request);
        int_to_string($history_list['itemList'], ['alarmType' => C('ALARM_TYPE'), 'processResult' => C('PROCESS_RESULT_TYPE')]);

        $this->assign('list', $history_list['itemList']);
        $this->assign('processMode', $processList);
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

    //新增报警处理记录
    function warning_add_deal()
    {
        $alarmId = I('');
    }
}