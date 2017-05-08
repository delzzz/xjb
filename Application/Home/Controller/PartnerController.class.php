<?php
namespace Home\Controller;

class PartnerController extends HomeController
{
    function index()
    {
        $joinCondition = get_document_one('join_condition');  //加盟条件
        $joinFlow = get_document_one('join_flow');  //加盟流程
        $profitModel = get_document_one('profit_model'); //盈利模式
        $question = get_document_one('question');  //常见问题
        $service = get_document_one('service'); //增值服务
        $this->assign('title','VR-合作共赢');
        $this->assign('joinCondition', $joinCondition);
        $this->assign('joinFlow', $joinFlow);
        $this->assign('profitModel', $profitModel);
        $this->assign('question', $question);
        $this->assign('service', $service);
        $this->display();
    }
}