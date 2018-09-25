<?php

namespace Lexin\Func;

class Csv
{
    /**
     * 根据数组导出csv文件
     * @param  array  一维索引数组，第一行可以为title行，该方法将输出每一行每一列
     * @param  string 文件名
     */
    public static function export(Array $data, $file_name = 'file')
    {
        ob_clean();
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . $file_name . '.csv');
        foreach ($data as $key => $value) {
            //关键字过滤
            $line_data = array_map(function ($d) {
                return str_replace([',', "\n"], ['，', ' '], $d);
            }, $value);
            $line = join(',', $line_data);
            echo iconv('utf-8', 'gbk//IGNORE', $line . PHP_EOL);
        }
    }
}
