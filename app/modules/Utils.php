<?php

/**
 * Class Utils
 * 
 * Utility methods
 */
class Utils
{
    /**
     * Return URL without HTTP or HTTPS port
     * 
     * @return string
     */
    public static function url($to)
    {
        $url = url($to);

        if (strpos($url, ':80/') !== false) {
            $url = str_replace(':80/', '/', $url);
        }

        if (strpos($url, ':443/') !== false) {
            $url = str_replace(':443/', '/', $url);
        }

        return $url;
    }
}
