<?php
    namespace app\index\controller;

    class Index
    {
        public function index()
        {
            //重定向至登录
            return redirect(url('/user/login/index/'));
        }
    }