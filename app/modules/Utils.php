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

    /**
     * Filter markdown code
     * 
     * @param $content
     * @return string
     */
    public static function filter_markdown($content)
    {
        $tokens = ['h1', 'h2', 'h3', 'b', 'i', 'u', 'strike', 'spoiler', 'hr'];

        foreach ($tokens as $token) {
            $content = str_replace(['[' . $token . ']', '[/' . $token . ']'], '', $content);
        }

        return $content;
    }
}
