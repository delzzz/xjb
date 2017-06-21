<?php
namespace Admin\Controller;

class NoticeController extends AdminController
{
    function notice_agent()
    {
        $this->meta_title = "代理通知";
        $pageNo = I('get.p', 1);
        $url = $this->getUrl('notice_query') . '?pageNo=' . $pageNo . '&pageSize=' . C('PAGE_SIZE');
        $param = "{}";
        $list = $this->lists($url, $param);
        $this->assign('list', $list['itemList']);
        $this->display();
    }

    function del()
    {
        $ids = I('post.noticeId');
        $noticeId = json_encode(array_unique($ids));
        $url = $this->getUrl('notice_del');
        http_post_json($url, $noticeId);
        $this->success('删除成功');
    }

    //广播页面
    function notice_fm()
    {
        //查询广播
        $pageNo = I('get.p', 1);
        //C('INTERFACR_API')['query_broadcast']
        $url = 'http://192.168.1.250:8080/service/msg/broadcast/query?pageNo=' . $pageNo . '&pageSize=' . C('PAGE_SIZE');
        $param = http_post_json($url,null);
        $list = $this->lists($url, $param);
        dump($list);
        $this->display();
    }

    //新增广播
    function addBroadcast(){
        if(isset($_POST['content'])){
            send_broadcast(UID,,$_POST['content']);
        }
    }

    function feedback()
    {
        $this->display();
    }
}