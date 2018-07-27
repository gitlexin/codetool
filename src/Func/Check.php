<?php
namespace Lexin\Func;

class Check
{
    /**
     * 验证手机号
     */
    public static function check_mobile($mobile){
        return preg_match('/^1(3[0-9]|4[57]|5[0-35-9]|7[0135678]|8[0-9])\\d{8}$/', (string)$mobile);
    }

    
}
