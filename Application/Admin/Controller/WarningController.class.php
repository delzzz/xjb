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
        $process_result_type = C('PROCESS_RESULT_TYPE');
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
        if (!empty($response['processResult'])) {
            $processResultAttr = explode(',', $response['processResult']);
            foreach ($process_result_type as $key => &$value) {
                foreach ($processResultAttr as $val) {
                    if ($key == $val) {
                        $value = ['name' => $value['name'], 'checked' => 'checked'];
                    }
                }
            }
        }
        $this->assign('status',I('status'));
        $this->assign('result_type', $process_result_type);
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
        $url = $this->getUrl('warning_list') . '?pageNo=' . $pageNo . '&pageSize=' . C('PAGE_SIZE').'&id='.$this->__get('orgId').'&type='.$this->__get('userType');
        if(I('alarmType')&&I('alarmType')!=0){
            $param = json_encode(['status'=>1,'alarmType'=>I('alarmType')]);
        }
        else{
            $param = json_encode(['status'=>1]);
        }
        $list = $this->lists($url, $param);
        $warning_status = C('WARNING_STATUS');
        int_to_string($list['itemList'], ['gender' => ['1' => '女', 0 => '男'], 'alarmType' => $warning_status]);
        $this->assign('status',1);
        $this->assign('warning_status', $warning_status);
        $this->assign('list', $list['itemList']);
        $this->display();
    }

    function warning_current()
    {
        $this->meta_title = "历史报警";
        $pageNo = I('get.p', 1);
        $url = $this->getUrl('warning_list') . '?pageNo=' . $pageNo . '&pageSize=' . C('PAGE_SIZE').'&id='.$this->__get('orgId').'&type='.$this->__get('userType');
        $param = json_encode(['status'=>0]);
        $list = $this->lists($url, $param);
        $warning_status = C('WARNING_STATUS');
        int_to_string($list['itemList'], ['gender' => ['1' => '女', 0 => '男'], 'alarmType' => $warning_status]);
        $this->assign('status',0);
        $this->assign('warning_status', $warning_status);
        $this->assign('list', $list['itemList']);
        $this->display('warning_history');
    }

    //已处理
    function warning_have_deal()
    {
        $param = $_POST;
        $processResult = null;
        if (!empty($param['processResult'])) {
            $processResult = implode(',', $param['processResult']);
        }
        $requestData = think_json_encode(['id' => $param['alarmId'], 'processUserId' => UID, 'processResult' => $processResult, 'processRemark' => $param['processRemark']]);
        $url = $this->getUrl('warning_deal');
        $response = http_post_json($url, $requestData);
        if (!empty($response)) {
            $this->success('保存成功',U('warning_history'));
        } else {
            $this->error('保存失败');
        }
    }
}