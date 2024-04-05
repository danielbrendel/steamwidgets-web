<?php

/**
 * Class SteamCache
 * 
 * Cached gateway to Steam Web API queries
 */
class SteamCache {
    public static function cachedSteamApp($appid, $lang)
    {
        $cache_driver = env('CACHE_DRIVER', null);
        $cache_duration = env('CACHE_DURATION', 123);

        if ($cache_driver === 'db') {
            return json_decode(CacheModel::remember('steam_app_' . $appid . '_' . $lang, $cache_duration, function() use ($appid, $lang) {
                return json_encode(SteamApp::querySteamData($appid, $lang));
            }));
        } else if ($cache_driver === 'redis') {

        } else {
            return SteamApp::querySteamData($appid, $lang);
        }
    }
}
