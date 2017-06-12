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

    function notice_fm()
    {
        $this->display();
    }

    function feedback()
    {
        $this->display();
    }
}