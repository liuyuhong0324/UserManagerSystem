<?php
namespace app\user\controller;

use app\user\model\User;
use think\Controller;


class Index extends Controller
{
    function index()
    {
        $session = session('user');
        //判断用户是否登录,后续使用公共类继承解决,不用每次判断
        if($session)
        {
            //session('logined',request()->url());
            $user = new User();
            $user -> select();
            $list = $user -> paginate();
            return view('index',['list' => $list]);
        }
        else
        {
            return $this->error("您还未登录,请登录!",'/user/login/index');
        }
    }

    function edit($username)
    {
        $session = session('user');
        //判断用户是否登录,后续使用公共类继承解决,不用每次判断
        if($session)
        {
            //session('logined',request()->url());
            $user = new User();
            $user = $user -> where('username',$username);
            $list = $user -> paginate();
            return view('edit',['list' => $list]);
        }
        else
        {
            return $this->error("您还未登录,请登录!",'/user/login/index');
        }
    }

    function delete($username)
    {
        return view();
    }
}