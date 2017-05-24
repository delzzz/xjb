<?php
namespace Admin\Controller;

class AreaController extends AdminController
{
    function getArea()
    {
        $parentId = I('get.parentId', 0);
        $url = $this->getUrl('get_area');
        $param = ['parentId' => $parentId];
        $response = http($url, $param, 'GET');
        echo think_json_encode($response);
    }
}