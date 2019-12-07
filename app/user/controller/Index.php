<?php
namespace app\user\controller;

use app\user\model\User;
use think\Controller;


class Index extends Controller
{
    function index()
    {
        $user = new User();
        $user -> select();
        $list = $user -> paginate();
        return view('index',['list' => $list]);
    }
}