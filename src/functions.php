<?php
/**
 * 打印并结束程序
 */
if (!function_exists('pe')) {
    function pe()
    {
        call_user_func_array('\Lexin\Func\Debug::pe', func_get_args());
    }
}

/**
 * 打印
 */
if (!function_exists('p')) {
    function p()
    {
        call_user_func_array('\Lexin\Func\Debug::p', func_get_args());
    }
}

/**
 * 实时输出字符串
 */
if (!function_exists('show_trace_info')) {
    function show_trace_info($msg)
    {
        call_user_func('\Lexin\Func\Debug::show_trace_info', $msg);
    }
}

if (!function_exists('lx_is')) {
    function lx_is($value, $rule)
    {
        if (is_callable('\Lexin\Func\Validate::is_' . $rule)) {
            return call_user_func('\Lexin\Func\Validate::is_' . $rule, $value);
        } else {
            throw new Exception("{$rule} does not support.");
        }
    }
}
