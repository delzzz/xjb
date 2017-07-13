<?php
// +----------------------------------------------------------------------
// | OneThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.onethink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: 麦当苗儿 <zuojiazi@vip.qq.com> <http://www.zjzit.cn>
// +----------------------------------------------------------------------
namespace Admin\Controller;

use Think\Controller;
use Admin\Model\AuthRuleModel;

/**
 * 后台首页控制器
 * @author 麦当苗儿 <zuojiazi@vip.qq.com>
 */
class AdminController extends Controller
{
    /**
     * 后台控制器初始化
     */
    protected function _initialize()
    {
        // 获取当前用户ID
        define('UID', is_login());
        if (!UID) {// 还没登录 跳转到登录页面
            $this->redirect('Public/login');
        }
        $right = $this->getRight();
        $this->assign('menu', $right);
        $this->assign('h_degree',$this->orgAgent()['degree']);
        $url = C('INTERFACR_API')['get_user'];
        $userinfo = session('user_auth');
        $User = http($url, ['userName' => $userinfo['userName']], 'GET');
        $this->assign('onlineStatus',$User['onlineStatus']);
        $this->assign('h_extendFlag',$this->orgAgent()['extendFlag']);
        //坐席代理商机构判断
        $this->assign('userType',$userinfo['userType']);
        if($userinfo['userType']==1){
            //代理商
            $this->assign('orgName', $this->orgName());
            $this->assign('orgId',$this->orgId());
            $this->assign('orgType',$this->orgType());
        }
        elseif ($userinfo['userType']==2){
            //机构
            $insInfo = $this->orgIns();
            $this->assign('orgName',$insInfo['orgOrganization']['orgName']);
            $this->assign('orgId',$insInfo['orgOrganization']['orgId']);
            $this->assign('orgType',$insInfo['orgOrganization']['orgType']);
        }
        else{
            //坐席
            $csInfo = http( C('INTERFACR_API')['zuoxi_detail'].$userinfo['objectId'], null, 'GET');
            $this->assign('zxPic',$csInfo['photo']['imagePath']);
            $this->assign('zxName',$csInfo['name']);
            $this->assign('zxNum',$csInfo['userName']);
            $this->assign('orgName',$csInfo['orgOrganization']['orgName']);
            $this->assign('orgId',$csInfo['orgOrganization']['orgId']);
            $this->assign('orgType',$csInfo['orgOrganization']['orgType']);
        }
    }

    //获取当前用户权限
    protected function getRight()
    {
        $url = $this->getUrl('get_right') . is_login();
        $response = http($url, null, 'GET');
        return $response;

    }

    protected function orgName($orgId = 0)
    {
        return $this->orgAgent($orgId)['orgOrganization']['orgName'];
    }

    protected function agentId()
    {
        return $this->orgAgent()['agentId'];
    }

    protected function orgId()
    {
        return $this->orgAgent(0, 'orgId');
    }

    protected function orgType()
    {
        return $this->orgAgent()['orgOrganization']['orgType'];
    }

    protected function orgAgent($orgId = 0, $fild = '')
    {
        $User = session('user_auth');
        if (empty($orgId)) {
            $orgId = $User['objectId'];
        }
        $orgAgent = http(C('INTERFACR_API')['get_org_agent'], ['orgId' => $orgId], 'GET');
        if (!empty($fild)) {
            return $orgAgent[$fild];
        }
        return $orgAgent;
    }

    protected function orgIns($orgId = 0){
        $User = session('user_auth');
        if (empty($orgId)) {
            $orgId = $User['objectId'];
        }
        $orgIns = http(C('INTERFACR_API')['get_org_ins'], ['orgId' => $orgId], 'GET');
        return $orgIns;
    }

    protected function delPicture($imgId)
    {
        $baseUrl = $this->getUrl('del_pic');
        $url = $baseUrl . $imgId;
        $response = http($url, null, 'GET');
        return json_encode($response);
    }

    /**
     * 对数据表中的单行或多行记录执行修改 GET参数id为数字或逗号分隔的数字
     *
     * @param string $model 模型名称,供M函数使用的参数
     * @param array $data 修改的数据
     * @param array $where 查询时的where()方法的参数
     * @param array $msg 执行正确和错误的消息 array('success'=>'','error'=>'', 'url'=>'','ajax'=>false)
     *                     url为跳转页面,ajax是否ajax方式(数字则为倒数计时秒数)
     *
     * @author 朱亚杰  <zhuyajie@topthink.net>
     */
    final protected function editRow($model, $data, $where, $msg)
    {
        $id = array_unique((array)I('id', 0));
        $id = is_array($id) ? implode(',', $id) : $id;
        $where = array_merge(array('id' => array('in', $id)), (array)$where);
        $msg = array_merge(array('success' => '操作成功！', 'error' => '操作失败！', 'url' => '', 'ajax' => IS_AJAX), (array)$msg);
        if (M($model)->where($where)->save($data) !== false) {
            $this->success($msg['success'], $msg['url'], $msg['ajax']);
        } else {
            $this->error($msg['error'], $msg['url'], $msg['ajax']);
        }
    }

    /**
     * 禁用条目
     * @param string $model 模型名称,供D函数使用的参数
     * @param array $where 查询时的 where()方法的参数
     * @param array $msg 执行正确和错误的消息,可以设置四个元素 array('success'=>'','error'=>'', 'url'=>'','ajax'=>false)
     *                     url为跳转页面,ajax是否ajax方式(数字则为倒数计时秒数)
     *
     * @author 朱亚杰  <zhuyajie@topthink.net>
     */
    protected function forbid($model, $where = array(), $msg = array('success' => '状态禁用成功！', 'error' => '状态禁用失败！'))
    {
        $data = array('status' => 0);
        $this->editRow($model, $data, $where, $msg);
    }

    /**
     * 恢复条目
     * @param string $model 模型名称,供D函数使用的参数
     * @param array $where 查询时的where()方法的参数
     * @param array $msg 执行正确和错误的消息 array('success'=>'','error'=>'', 'url'=>'','ajax'=>false)
     *                     url为跳转页面,ajax是否ajax方式(数字则为倒数计时秒数)
     *
     * @author 朱亚杰  <zhuyajie@topthink.net>
     */
    protected function resume($model, $where = array(), $msg = array('success' => '状态恢复成功！', 'error' => '状态恢复失败！'))
    {
        $data = array('status' => 1);
        $this->editRow($model, $data, $where, $msg);
    }

    /**
     * 还原条目
     * @param string $model 模型名称,供D函数使用的参数
     * @param array $where 查询时的where()方法的参数
     * @param array $msg 执行正确和错误的消息 array('success'=>'','error'=>'', 'url'=>'','ajax'=>false)
     *                     url为跳转页面,ajax是否ajax方式(数字则为倒数计时秒数)
     * @author huajie  <banhuajie@163.com>
     */
    protected function restore($model, $where = array(), $msg = array('success' => '状态还原成功！', 'error' => '状态还原失败！'))
    {
        $data = array('status' => 1);
        $where = array_merge(array('status' => -1), $where);
        $this->editRow($model, $data, $where, $msg);
    }

    /**
     * 条目假删除
     * @param string $model 模型名称,供D函数使用的参数
     * @param array $where 查询时的where()方法的参数
     * @param array $msg 执行正确和错误的消息 array('success'=>'','error'=>'', 'url'=>'','ajax'=>false)
     *                     url为跳转页面,ajax是否ajax方式(数字则为倒数计时秒数)
     *
     * @author 朱亚杰  <zhuyajie@topthink.net>
     */
    protected function delete($model, $where = array(), $msg = array('success' => '删除成功！', 'error' => '删除失败！'))
    {
        $data['status'] = -1;
        $data['update_time'] = NOW_TIME;
        $this->editRow($model, $data, $where, $msg);
    }

    /**
     * 设置一条或者多条数据的状态
     */
    public function setStatus($Model = CONTROLLER_NAME)
    {

        $ids = I('request.ids');
        $status = I('request.status');
        if (empty($ids)) {
            $this->error('请选择要操作的数据');
        }

        $map['id'] = array('in', $ids);
        switch ($status) {
            case -1 :
                $this->delete($Model, $map, array('success' => '删除成功', 'error' => '删除失败'));
                break;
            case 0  :
                $this->forbid($Model, $map, array('success' => '禁用成功', 'error' => '禁用失败'));
                break;
            case 1  :
                $this->resume($Model, $map, array('success' => '启用成功', 'error' => '启用失败'));
                break;
            default :
                $this->error('参数错误');
                break;
        }
    }

    /**
     * 获取控制器菜单数组,二级菜单元素位于一级菜单的'_child'元素中
     * @author 朱亚杰  <xcoolcc@gmail.com>
     */
    final public function getMenus($controller = CONTROLLER_NAME)
    {
        // $menus  =   session('ADMIN_MENU_LIST'.$controller);
        if (empty($menus)) {
            // 获取主菜单
            $where['pid'] = 0;
            $where['hide'] = 0;
            if (!C('DEVELOP_MODE')) { // 是否开发者模式
                $where['is_dev'] = 0;
            }
            $menus['main'] = M('Menu')->where($where)->order('sort asc')->select();

            $menus['child'] = array(); //设置子节点

            //高亮主菜单
            $current = M('Menu')->where("url like '%{$controller}/" . ACTION_NAME . "%'")->field('id')->find();
            if ($current) {
                $nav = D('Menu')->getPath($current['id']);
                $nav_first_title = $nav[0]['title'];

                foreach ($menus['main'] as $key => $item) {
                    if (!is_array($item) || empty($item['title']) || empty($item['url'])) {
                        $this->error('控制器基类$menus属性元素配置有误');
                    }
                    if (stripos($item['url'], MODULE_NAME) !== 0) {
                        $item['url'] = MODULE_NAME . '/' . $item['url'];
                    }
                    // 判断主菜单权限
                    if (!IS_ROOT && !$this->checkRule($item['url'], AuthRuleModel::RULE_MAIN, null)) {
                        unset($menus['main'][$key]);
                        continue;//继续循环
                    }

                    // 获取当前主菜单的子菜单项
                    if ($item['title'] == $nav_first_title) {
                        $menus['main'][$key]['class'] = 'current';
                        //生成child树
                        $groups = M('Menu')->where("pid = {$item['id']}")->distinct(true)->field("`group`")->select();
                        if ($groups) {
                            $groups = array_column($groups, 'group');
                        } else {
                            $groups = array();
                        }

                        //获取二级分类的合法url
                        $where = array();
                        $where['pid'] = $item['id'];
                        $where['hide'] = 0;
                        if (!C('DEVELOP_MODE')) { // 是否开发者模式
                            $where['is_dev'] = 0;
                        }
                        $second_urls = M('Menu')->where($where)->getField('id,url');

                        if (!IS_ROOT) {
                            // 检测菜单权限
                            $to_check_urls = array();
                            foreach ($second_urls as $key => $to_check_url) {
                                if (stripos($to_check_url, MODULE_NAME) !== 0) {
                                    $rule = MODULE_NAME . '/' . $to_check_url;
                                } else {
                                    $rule = $to_check_url;
                                }
                                if ($this->checkRule($rule, AuthRuleModel::RULE_URL, null))
                                    $to_check_urls[] = $to_check_url;
                            }
                        }
                        // 按照分组生成子菜单树
                        foreach ($groups as $g) {
                            $map = array('group' => $g);
                            if (isset($to_check_urls)) {
                                if (empty($to_check_urls)) {
                                    // 没有任何权限
                                    continue;
                                } else {
                                    $map['url'] = array('in', $to_check_urls);
                                }
                            }
                            $map['pid'] = $item['id'];
                            $map['hide'] = 0;
                            if (!C('DEVELOP_MODE')) { // 是否开发者模式
                                $map['is_dev'] = 0;
                            }
                            $menuList = M('Menu')->where($map)->field('id,pid,title,url,tip')->order('sort asc')->select();
                            $menus['child'][$g] = list_to_tree($menuList, 'id', 'pid', 'operater', $item['id']);
                        }
                        if ($menus['child'] === array()) {
                            //$this->error('主菜单下缺少子菜单，请去系统=》后台菜单管理里添加');
                        }
                    }
                }
            }
            // session('ADMIN_MENU_LIST'.$controller,$menus);
        }
        return $menus;
    }

    /**
     * 返回后台节点数据
     * @param boolean $tree 是否返回多维数组结构(生成菜单时用到),为false返回一维数组(生成权限节点时用到)
     * @retrun array
     *
     * 注意,返回的主菜单节点数组中有'controller'元素,以供区分子节点和主节点
     *
     * @author 朱亚杰 <xcoolcc@gmail.com>
     */
    final protected function returnNodes($tree = true)
    {
        static $tree_nodes = array();
        if ($tree && !empty($tree_nodes[(int)$tree])) {
            return $tree_nodes[$tree];
        }
        if ((int)$tree) {
            $list = M('Menu')->field('id,pid,title,url,tip,hide')->order('sort asc')->select();
            foreach ($list as $key => $value) {
                if (stripos($value['url'], MODULE_NAME) !== 0) {
                    $list[$key]['url'] = MODULE_NAME . '/' . $value['url'];
                }
            }
            $nodes = list_to_tree($list, $pk = 'id', $pid = 'pid', $child = 'operator', $root = 0);
            foreach ($nodes as $key => $value) {
                if (!empty($value['operator'])) {
                    $nodes[$key]['child'] = $value['operator'];
                    unset($nodes[$key]['operator']);
                }
            }
        } else {
            $nodes = M('Menu')->field('title,url,tip,pid')->order('sort asc')->select();
            foreach ($nodes as $key => $value) {
                if (stripos($value['url'], MODULE_NAME) !== 0) {
                    $nodes[$key]['url'] = MODULE_NAME . '/' . $value['url'];
                }
            }
        }
        $tree_nodes[(int)$tree] = $nodes;
        return $nodes;
    }


    /**
     * 通用分页列表数据集获取方法
     *
     *  可以通过url参数传递where条件,例如:  index.html?name=asdfasdfasdfddds
     *  可以通过url空值排序字段和方式,例如: index.html?_field=id&_order=asc
     *  可以通过url参数r指定每页数据条数,例如: index.html?r=5
     *
     * @param sting|Model $model 模型名或模型实例
     * @param array $where where查询条件(优先级: $where>$_REQUEST>模型设定)
     * @param array|string $order 排序条件,传入null时使用sql默认排序或模型属性(优先级最高);
     *                              请求参数中如果指定了_order和_field则据此排序(优先级第二);
     *                              否则使用$order参数(如果$order参数,且模型也没有设定过order,则取主键降序);
     *
     * @param array $base 基本的查询条件
     * @param boolean $field 单表模型用不到该参数,要用在多表join时为field()方法指定参数
     * @author 朱亚杰 <xcoolcc@gmail.com>
     *
     * @return array|false
     * 返回数据集
     */
    protected function lists($url, $params, $method = 'POST', $order = '')
    {
        if ($method == 'POST') {
            $list = http_post_json($url, $params);
        } else {
            $list = http($url,$params,'GET');
        }
        $total = $list['totalCount'];
        $REQUEST = (array)I('request.');
        if (isset($REQUEST['r'])) {
            $listRows = (int)$REQUEST['r'];
        } else {
            $listRows = C('PAGE_SIZE');
        }
        $page = new \Think\Page($total, $listRows, $REQUEST,'p');
        if ($total > $listRows) {
            $page->setConfig('theme', '%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%');
        }
        $p = $page->show();
        $this->assign('_page', $p ? $p : '');

        $this->assign('_total', $total);
        return $list;
    }


    protected function lists2($url, $params, $order = '')
    {
        $list = http_post_json($url, $params);
        $total = $list['totalCount'];
        $REQUEST = (array)I('request.');
        if (isset($REQUEST['r'])) {
            $listRows = (int)$REQUEST['r'];
        } else {
            $listRows = C('PAGE_SIZE');
        }
        $page2 = new \Think\Page($total, $listRows, $REQUEST,'p2');
        $page2->p = "p2";
        if ($total > $listRows) {
            $page2->setConfig('theme', '%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%');
        }
        $p = $page2->show();
        $this->assign('_page2', $p ? $p : '');
        $this->assign('_total2', $total);
        return $list;
    }



    //获取接口
    protected function getUrl($interFace)
    {
        return C('INTERFACR_API')[$interFace];
    }

}
