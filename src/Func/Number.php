<?php

namespace Lexin\Func;

class Number
{
    /**
     * 保留指定位数小数
     * @param $num
     * @param int $size
     * @return float|int
     */
    public static function float_floor($num, $size = 2)
    {
        $str = strval($num);
        list($int, $float) = explode('.', $str);
        $float = substr($float, 0, $size);
        return $float > 0 ? floatval($int . '.' . $float) : intval($int);
    }

    /**
     * 过滤字符串内的字符串
     * @param $str
     * @param bool $float 是否保留小数
     * @return string
     */
    public static function filter_num($str, $float = false)
    {
        $preg = $float ? '[0-9\.]*' : '\d*';
        $num = preg_match_all("/{$preg}/", $str, $out);
        if ($num) {
            return join(array_values($out[0]));
        }
        return '';
    }
}
