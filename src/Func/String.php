<?php
namespace Lexin\Func;

class String
{
    /**
     * 截取字符串并添加省略符
     * @param $str
     * @param int $len
     * @param string $subfix
     * @return string
     */
    function cutstr($str, $len = 5, $subfix = '...'){
        return mb_substr($str, 0, $len) . (mb_strlen($str) > $len ? $subfix : '');
    }
}
