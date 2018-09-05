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

    public static function output($content) {
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

    /**
     * 实时输出文本内容
     * @param string $msg
     */
    public static function show_trace_info($msg='')
    {
        ob_start();
        echo date('m-d H:i:s'),',memory:'.self::memory_usage_convert(memory_get_usage(true)), ' ';
        if (is_string($msg)) {
            echo $msg;
        } else {
            print_r($msg);
        }
        echo PHP_SAPI == 'cli' ? PHP_EOL : '<br/>';
        ob_end_flush();
        flush();
    }

    /**
     * 将字节大小转换为可读性强的带单位的显示方式
     * @param $size
     * @return string
     */
    public static function memory_usage_convert($size)
    {
        $unit=array('b','kb','mb','gb','tb','pb');
        return @round($size/pow(1024,($i=floor(log($size,1024)))),2).''.$unit[$i];
    }
}
