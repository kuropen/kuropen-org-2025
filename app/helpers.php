<?php
if (!function_exists('compare_url')) {
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
