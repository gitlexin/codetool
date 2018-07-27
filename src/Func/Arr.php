<?php
namespace Lexin\Func;

class Arr
{
    //获取数组内容
    public static function get($array, $key, $default = null) {
        if (!is_array($array)) {
            return $default;
        }

        if (is_null($key)) {
            return $array;
        }

        if (array_key_exists($key, $array)) {
            return $array[$key];
        }

        foreach (explode('.', $key) as $segment) {
            if (is_array($array) && array_key_exists($segment, $array)) {
                $array = $array[$segment];
            } else {
                return $default;
            }
        }

        return $array;
    }

    //将一维数组按照指定的字段分组
    public static function group_by(Array $array, String $fieldName) {
        if (is_array($array) && $fieldName) {
            $tmp = [];
            foreach($array as $v) {
                if (isset($v[$fieldName]) && $v[$fieldName]) {
                    $tmp[$v[$fieldName]][] = $v;
                }
            }

            return $tmp;
        }

        return false;
    }

    /**
     * 将数据根据某个字段排序 支持desc和asc
     * 1.目前只能支持全部desc或者asc，如需使用根据字段随意的asc,desc 请使用column_multisort
     * @param  array  需要排序的数据
     * @param  mixed  排序字段列表 eg. name,age
     * @param  string 排序规则 asc,desc default: desc 
     * @return array
     */
    public static function column_sort(Array & $data, $columns, $order = 'desc'){
        $order = strtolower($order);
        if (is_string($columns)) {
            $columns = explode(',', $columns);
        }
        if (empty($columns)) {
            return false;
        }
        function array_column_sort_tmp_func($columnss, $order) {
            return function ($a,$b) use ($columnss, $order) {
                foreach($columnss as $columns) {
                    if ($a[$columns] == $b[$columns]) {
                        continue;
                    }
                    if ($order == 'desc') {
                        return $a[$columns] < $b[$columns];
                    } else if ($order == 'asc') {
                        return $a[$columns] > $b[$columns];
                    }
                    return false;
                }
            };
        }
        usort($data, array_column_sort_tmp_func($columns, $order));
    }

    /**
     * 将数组按照指定字段升降序排列
     * 模拟sql中的写法
     * @param  array $list 需要排序的二维数组
     * @param  string $sort_map 排序方式 与sql中的order写法一致 asc升序 desc降序 
     * 比如name asc,age desc 多个字段以逗号分隔，排序值以空格分隔 
     * 也可以写作name,age desc 默认是asc
     */
    public static function column_multisort(Array & $list, $sort_map) {
        $field_sort = explode(',', trim(trim($sort_map, ',')));
        $final_sort_arr = [];
        foreach($field_sort as $k => $value) {
            list($field, $sort_type) = explode(' ', $value);
            if (empty($field)) {
                return false;
            }

            switch ($sort_type) {
                case 'asc': $sort_type = SORT_ASC; break;
                case 'desc': $sort_type = SORT_DESC; break;
                default: $sort_type = SORT_ASC; break;
            }

            $field_data = array_column($list, $field);
            if (empty($field_data)) {
                return false;
            }

            $final_sort_arr = array_merge($final_sort_arr, [
                $field_data,
                $sort_type,
            ]);
        }
        $final_sort_arr[] = &$list;
        

        call_user_func_array('array_multisort', $final_sort_arr);
    }
}
