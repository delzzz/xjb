<?php
namespace Admin\Controller;

class NoticeController extends AdminController
{
    function notice_agent()
    {
        $this->meta_title = "代理通知";
        $pageNo = I('get.p', 1);
        $url = $this->getUrl('notice_query') . '?pageNo=' . $pageNo . '&pageSize=' . C('PAGE_SIZE');
        $param = "{\"agentId\":".$this->agentId()."}";
        $list = $this->lists($url, $param);

        $this->assign('list', $list['itemList']);
        $this->display();
    }

    /**
     * 设置已读接口
     */
    function notice_read()
    {
        $sids=I('post.ids');
        set_read_notice($sids);
    }
    function count()
    {
        $param="{\"agentId\":".$this->agentId().",\"readFlag\":0}";
        $url=$this->getUrl('notice_get_count');

        echo http_post_json($url,$param);

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
        //
        $url = C('INTERFACR_API')['query_broadcast'].$pageNo.'&pageSize='.C('PAGE_SIZE');
        $list = $this->lists($url, "{}");
        $this->assign('list', $list['itemList']);
        $this->display();
    }

    //新增广播
    function addBroadcast(){
        if(isset($_POST['content'])){
            if(empty($_POST['content'])){
                $this->error('请输入广播内容!');
            }
            $user = get_user_auth();
            $res = send_broadcast(UID,$user['userName'],$_POST['content']);
            if($res['success']){
                $this->success('发送成功!');
            }
            else{
                $this->error('发送失败!');
            }
        }
    }

    //删除广播
    function delBroadcast(){
        if(I('bid')){
            $res = del_broadcast(I('bid'));
            $this->success('删除成功',U('notice_fm'));
        }
    }

    function feedback()
    {
        $this->meta_title = "意见反馈";
        $pageNo = I('get.p', 1);
        $url = $this->getUrl('feeback');
        $param = ['pageNo' => $pageNo, 'pageSize' => C('PAGE_SIZE')];
        $list = $this->lists($url, $param, 'GET');
        $this->assign('list', $list['itemList']);
        $this->display();
    }

    function del_feeback()
    {
        $ids = I('feedbackId');
        if (IS_GET) {
            $feedbackId = "[" . $ids . "]";
        } else {
            $feedbackId = json_encode($ids);
        }
        $url = $this->getUrl('del_feeback');
        http_post_json($url, $feedbackId);
        $this->success('删除成功');
    }
}