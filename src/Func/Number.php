<?
namespace Lexin\Func;

class Number
{
    //保留指定位数小数
    public static function float_floor($num, $size = 2) {
        $str = strval($num);
        list($int, $float) = explode('.', $str);
        $float = substr($float, 0, $size);
        return $float > 0 ? floatval($int . '.' . $float) : intval($int);
    }
}
