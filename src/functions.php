<?php
/**
 * 打印并结束程序
 */
if (!function_exists('pe')) {
	function pe() {
		call_user_func_array('\Lexin\Func\Debug::pe', func_get_args());
	}
}

/**
 * 打印
 */
if (!function_exists('p')) {
	function p() {
        call_user_func_array('\Lexin\Func\Debug::p', func_get_args());
	}
}
