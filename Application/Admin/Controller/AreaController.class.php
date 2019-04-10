<?php
namespace Admin\Controller;

class AreaController extends AdminController
{
    function getArea()
    {
        $parentId = 0;
        $url = $this->getUrl('get_area');
        $param = ['parentId' => $parentId];
        $response = http($url, $param, 'GET');
        echo think_json_encode($response);
    }
    function getCity()
    {
        $parentId = I('post.parentId');
        if(empty($parentId)){
            echo "";die();
        }
        $url = $this->getUrl('get_area');
        $param = ['parentId' => $parentId];
        $response = http($url, $param, 'GET');
        echo think_json_encode($response);
    }
    //获取省/市/县名称
//    function getName($id,$parentId,$degree)
//    {
//        if($degree == 1){
//            $parentId = 0;
//            $url = $this->getUrl('get_area');
//            $param = ['parentId' => $parentId];
//            $response = http($url, $param, 'GET');
//            foreach ($response as $key => $value){
//                if($value['regionId'] == $id){
//                    return $value['name'];
//                }
//            }
//        }
//        else if($degree == 2 || $degree == 3) {
//            $url = $this->getUrl('get_area');
//            $param = ['parentId' => $parentId];
//            $response = http($url, $param, 'GET');
//            foreach ($response as $key => $value) {
//                if ($value['regionId'] == $id) {
//                    return $value['name'];
//                }
//            }
//        }
//    }

    //获取完整省市县名称
    function getFullName($provinceId,$cityId,$countyId,$degree){
        if($degree == 1){
            $province = $this->getName($provinceId,null,1);
            return $province;
        }
        elseif($degree == 2){
            $province = $this->getName($provinceId,null,1);
            $city = $this->getName($cityId,$provinceId,2);
            return $province.$city;
        }
        elseif($degree ==3){
            $province = $this->getName($provinceId,null,1);
            $city = $this->getName($cityId,$provinceId,2);
            $county = $this->getName($countyId,$cityId,3);
            return $province.$city.$county;
        }
    }
}
