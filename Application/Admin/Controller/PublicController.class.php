<?php
// +----------------------------------------------------------------------
// | OneThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.onethink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: 麦当苗儿 <zuojiazi@vip.qq.com> <http://www.zjzit.cn>
// +----------------------------------------------------------------------

namespace Admin\Controller;

use User\Api\UserApi;

/**
 * 后台首页控制器
 * @author 麦当苗儿 <zuojiazi@vip.qq.com>
 */
class PublicController extends \Think\Controller
{

    /**
     * 后台用户登录
     * @author 麦当苗儿 <zuojiazi@vip.qq.com>
     */
    public function login($username = null, $password = null, $verify = null)
    {
        if (IS_POST) {
            /* 检测验证码 TODO: */
            if (!check_verify($verify)) {
                $this->error('验证码输入错误！');
            }
            /* 调用UC登录接口登录 */
            $url = C('INTERFACR_API')['get_user'];
            $User = json_decode(http($url, ['userCode' => "0000"]), true);
            if ($username === $User['userName'] && md5($password) === $User['password']) { //UC登录成功
                $this->success('登录成功！', U('Index/index'));
            } else { //登录失败
                if (empty($User)) {
                    $error = "系统错误";
                } else {
                    $error = "密码错误";
                }
                $this->error($error);
            }
        } else {
            if (is_login()) {
                $this->redirect('Index/index');
            } else {
                $this->display();
            }
        }
    }

    /* 退出登录 */
    public function logout()
    {
        if (is_login()) {
            session('user_auth', null);
            session('user_auth_sign', null);
            session('[destroy]');
            $this->success('退出成功！', U('login'));
        } else {
            $this->redirect('login');
        }
    }

    public function verify()
    {
        $verify = new \Think\Verify();
        $verify->entry(1);
    }

}
