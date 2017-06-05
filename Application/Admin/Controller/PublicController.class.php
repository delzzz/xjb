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
            $url = C('INTERFACR_API')['get_user'];
            $User = http($url, ['userName' =>$username], 'GET');
            if ($username === $User['userName'] && md5($password) === $User['password']) { //UC登录成功
                session('user_auth', $User);
                session('user_auth_sign', data_auth_sign($User));
                $this->success('登录成功！', U('Index/index'));
            } else { //登录失败
                if (empty($User)) {
                    $error = "登陆失败";
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
