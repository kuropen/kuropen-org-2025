<?php
if (!function_exists('compare_url')) {
    /**
     * URLのスキームとホストが一致しているかどうかを比較する.
     * @param $url1
     * @param $url2
     * @return bool
     */
    function compare_url($url1, $url2): bool
    {
        $url1 = parse_url($url1);
        $url2 = parse_url($url2);

        if ($url1['scheme'] !== $url2['scheme']) {
            return false;
        }

        if ($url1['host'] !== $url2['host']) {
            return false;
        }

        return true;
    }
}

if (!function_exists('get_client_ip')) {
    /**
     * クライアントのIPアドレスを取得する.
     * この関数はCloudflareのCF-Connecting-IPヘッダーを考慮しています.
     * @return string
     */
    function get_client_ip(): string
    {
        $request = request();
        if ($request->hasHeader('CF-Connecting-IP')) {
            return $request->header('CF-Connecting-IP');
        }
        return $request->ip();
    }
}
