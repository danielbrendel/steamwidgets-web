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

    public static function cachedSteamUser($key, $steamid)
    {
        $cache_driver = env('CACHE_DRIVER', null);
        $cache_duration = env('CACHE_DURATION', 123);

        if ($cache_driver === 'db') {
            return json_decode(CacheModel::remember('steam_user_' . $steamid, $cache_duration, function() use ($key, $steamid) {
                return json_encode(SteamUser::querySteamData($key, $steamid));
            }));
        } else if ($cache_driver === 'redis') {

        } else {
            return SteamUser::querySteamData($key, $steamid);
        }
    }

    public static function cachedSteamGroup($group)
    {
        $cache_driver = env('CACHE_DRIVER', null);
        $cache_duration = env('CACHE_DURATION', 123);

        if ($cache_driver === 'db') {
            return json_decode(CacheModel::remember('steam_group_' . $group, $cache_duration, function() use ($group) {
                return json_encode(SteamGroup::querySteamData($group));
            }));
        } else if ($cache_driver === 'redis') {

        } else {
            return SteamGroup::querySteamData($group);
        }
    }
}
