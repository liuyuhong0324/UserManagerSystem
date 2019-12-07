<?php
namespace app\user\model;

use app\common\model\BaseModel;

class User extends BaseModel
{
    //密码md5加密
    static function passwordEncode($pwd)
    {
        return md5($pwd);
    }

//    function setPasswordAttr($value)
//    {
//        if($value)
//        {
//            return self::passwordEncode($value);
//        }else{
//            return $this['password'];
//        }
//    }
}
