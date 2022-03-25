<?php
if (! function_exists('file_get_content_curl')) {
    function file_get_content_curl ($url)   {
        // Throw Error if the curl function does'nt exist.
        if (!function_exists('curl_init'))
        {
            die('CURL is not installed!');
        }
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $output = curl_exec($ch);
        curl_close($ch);
        return $output;
    }
}

if (! function_exists('getfolderName')) {
    function getfolderName(){
        return substr(str_shuffle("01234567890123456789"), 0, 2);
    }
}