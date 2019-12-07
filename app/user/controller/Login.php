<?php
namespace app\user\controller;

use app\user\model\User;
use think\Controller;

class Login extends Controller
{
    //登录方法
    function index()
    {
        if(request()->isPost())
        {
            $username = input('post.username') ?: dump("请输入用户名");
            $password = input('post.password') ?: dump("请输入密码");


//            $user = User::get(['username' => $username]) ?: dump("用户名不存在");
//            if($user -> setPasswordAttr($password) !== $user['password'])
//            {
//                dump("密码错误");
//            }

            $user = User::get(['username' => $username]);
            if(!$user)
            {
                dump("用户名不存在");
            }
            else
            {
                if($user -> passwordEncode($password) !== $user['password'])
                {
                    dump("密码错误");
                }
                else
                {
                    session('user',$user);
                    $url = session('logined') ?: url('index/index');
                    return $this->success('登录成功！', $url);
                }
            }
        }

        return view();
    }

    //注册方法
    function register()
    {
        if(request()->isPost())
        {
            $username = input('post.username');
            $password = input('post.password');
            $pwdconfirm = input('post.pwdconfirm');
            $mobile = input('post.mobile');
            if($password == null | $pwdconfirm == null)
            {
                dump("密码不能为空");
            }
            else
            {
                if($password!==$pwdconfirm)
                {
                    dump("两次输入密码不一致");
                }
                else
                {
                    if(!preg_match("/^1[0-9]{10}$/",$mobile))
                    {
                        dump("手机号码格式不正确");
                    }
                    else
                    {
                        if(!preg_match("/^1[0-9]{10}$/",$mobile))
                        {
                            dump("手机号码格式不正确");
                        }
                        else
                        {
                            $user = User::get(['username' => $username]);
                            $mobile = User::get(['mobile' => $mobile]);
                            if($user)
                            {
                                dump("该用户名已被注册");
                            }
                            else
                            {
                                if($mobile)
                                {
                                    dump("该手机号已被注册");
                                }
                                else
                                {
                                    $data = input('post.');
                                    $data['password']= User::passwordEncode($password);
                                    User::insert($data);
                                    session('user',$user);
                                    $url = session('logined') ?: url('index/index');
                                    return $this->success('注册成功',$url);
                                }
                            }
                        }
                    }
                }
            }
        }
        return view();
    }

    //登出方法
    function loguot()
    {
        session('user',null);
        $this->redirect('index');
    }
}
