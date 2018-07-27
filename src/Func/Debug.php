<?php
namespace Lexin\Func;

class Debug
{
    /**
     * 打印传入的所有参数，并结束程序
     */
    public static function buildStr($value) {
        $type = gettype($value);
        $print_str = '';
        switch ($type) {
            case 'integer':
                $print_str .= "({$type}) {$value}";
                break;
            case 'double':
                $print_str .= "({$type}) {$value}";
                break;
            case 'string':
                $value = $value ?: "''";
                $print_str .= "({$type}) {$value}";
                break;
            case 'boolean':
                $print_str .= "(boolean) " . ($value ? 'true' : 'false');
                break;
            case 'NULL':
                $print_str .= 'NULL';
                break;
            case 'array':
            case 'object':
                $print_str .= print_r($value, true);
                break;
            
            default:
                $print_str .= '参数type异常';
                break;
        }

        return $print_str;
    }

    public static function output(String $content) {
        ob_end_clean();
        echo "<meta charset='UTF-8'><pre class='xdebug-var-dump' dir='ltr'>",PHP_EOL;
        echo $content;
        echo '</pre>';
    }

    public static function pe() {
        $out = '';
        foreach(func_get_args() as $v) {
            $out .= print_r(self::buildStr($v), true) . PHP_EOL;
        }
        self::output($out);
        die;
    }

    public static function p() {
        $out = '';
        foreach(func_get_args() as $v) {
            $out .= print_r(self::buildStr($v), true) . PHP_EOL;
        }
        self::output($out);
    }
}
