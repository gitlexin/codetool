<?php

namespace Lexin\Func;

class Url
{
    /**
     * 追加url参数到url中,如果已存在，则覆盖
     * @param $url
     * @param array $appendQueryParams
     * @return string
     */
    public static function appendQueryParams($url, $appendQueryParams = [])
    {
        if (!Validate::is_url($url)) {
            return '';
        }

        $urlParse = parse_url($url);
        $query    = [];
        if (isset($urlParse['query'])) {
            parse_str($urlParse['query'], $query);
        }
        $query = array_merge($query, $appendQueryParams);

        return join('', [
            isset($urlParse['scheme']) ? $urlParse['scheme'] . '://' : '',
            $urlParse['host'],
            isset($urlParse['path']) ? $urlParse['path'] : '',
            $query ? '?' : '',
            http_build_query($query),
        ]);
    }
}
