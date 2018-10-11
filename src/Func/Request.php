<?php

namespace Lexin\Func;

class Request
{
    function is_mobile()
    {
        $mobile = array();
        $touchbrowser_list = array(
            'iphone',
            'android',
            'phone',
            'mobile',
            'wap',
            'netfront',
            'java',
            'opera mobi',
            'opera mini',
            'ucweb',
            'windows ce',
            'symbian',
            'series',
            'webos',
            'sony',
            'blackberry',
            'dopod',
            'nokia',
            'samsung',
            'palmsource',
            'xda',
            'pieplus',
            'meizu',
            'midp',
            'cldc',
            'motorola',
            'foma',
            'docomo',
            'up.browser',
            'up.link',
            'blazer',
            'helio',
            'hosin',
            'huawei',
            'novarra',
            'coolpad',
            'webos',
            'techfaith',
            'palmsource',
            'alcatel',
            'amoi',
            'ktouch',
            'nexian',
            'ericsson',
            'philips',
            'sagem',
            'wellcom',
            'bunjalloo',
            'maui',
            'smartphone',
            'iemobile',
            'spice',
            'bird',
            'zte-',
            'longcos',
            'pantech',
            'gionee',
            'portalmmm',
            'jig browser',
            'hiptop',
            'benq',
            'haier',
            '^lct',
            '320x320',
            '240x320',
            '176x220',
            'windows phone'
        );
        $wmlbrowser_list = array(
            'cect',
            'compal',
            'ctl',
            'lg',
            'nec',
            'tcl',
            'alcatel',
            'ericsson',
            'bird',
            'daxian',
            'dbtel',
            'eastcom',
            'pantech',
            'dopod',
            'philips',
            'haier',
            'konka',
            'kejian',
            'lenovo',
            'benq',
            'mot',
            'soutec',
            'nokia',
            'sagem',
            'sgh',
            'sed',
            'capitel',
            'panasonic',
            'sonyericsson',
            'sharp',
            'amoi',
            'panda',
            'zte'
        );

        $pad_list = array('ipad');

        $useragent = strtolower($_SERVER['HTTP_USER_AGENT']);

        if (strpos($useragent, $pad_list)) {
            return false;
        }
        if (($v = strpos($useragent, $touchbrowser_list, true))) {
            return '2';
        }
        if (($v = strpos($useragent, $wmlbrowser_list))) {
            return '3'; //wml版
        }
        $brower = array('mozilla', 'chrome', 'safari', 'opera', 'm3gate', 'winwap', 'openwave', 'myop');
        if (strpos($useragent, $brower)) {
            return false;
        }

        return false;
    }

}
