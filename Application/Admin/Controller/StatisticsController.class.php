<?php
namespace Admin\Controller;

class StatisticsController extends AdminController
{
    function index()
    {
        $userTotal = http($this->getUrl('statistics_total_users') . $this->get('orgId'), null, 'get');
        $this->assign('userTotal', $userTotal);
        $this->display();
    }

    function add()
    {
        if ($_GET['status'] == 1) {
            $newUsers = http($this->getUrl('statistics_new_users') . $this->get('orgId') . '/1', null, 'get');
        } else {
            $newUsers = http($this->getUrl('statistics_new_users') . $this->get('orgId') . '/0', null, 'get');
        }
        foreach ($newUsers['dayDetailList'] as $key => &$value) {
            $province = $this->getName($value['provinceId'], 0, 1);
            $value['area'] = $province . '（省/市）';
            if (!empty($value['cityId'])) {
                $city = $this->getName($value['cityId'], $value['provinceId'], 2);
                $value['area'] .= $city . '市';
            }
            if (!empty($value['countyId'])) {
                $county = $this->getName($value['countyId'], $value['cityId'], 3);
                $value['area'] .= $county . '（县/区）';
            }
        }
        $this->assign('dayDetailList', $newUsers['dayDetailList']);
        $this->display();
    }

    function silent()
    {
        $this->display();
    }

    function getData()
    {
        if (isset($_POST)) {
            if ($_POST['status'] == 1) {
                $newUsers = http($this->getUrl('statistics_new_users') . $this->get('orgId') . '/1', null, 'get');
            } else {
                $newUsers = http($this->getUrl('statistics_new_users') . $this->get('orgId') . '/0', null, 'get');
            }
            $this->ajaxReturn($newUsers['dayList']);
        }
    }

}