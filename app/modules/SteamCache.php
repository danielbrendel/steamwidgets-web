<?php

/**
 * Class SteamCache
 * 
 * Cached gateway to Steam Web API queries
 */
class SteamCache {
    /**
     * @param $appid
     * @param $lang
     * @return mixed
     */
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

    /**
     * @param $key
     * @param $steamid
     * @return mixed
     */
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

    /**
     * @param $itemid
     * @return mixed
     */
    public static function cachedSteamWorkshop($itemid)
    {
        $cache_driver = env('CACHE_DRIVER', null);
        $cache_duration = env('CACHE_DURATION', 123);

        if ($cache_driver === 'db') {
            return json_decode(CacheModel::remember('steam_workshop_' . $itemid, $cache_duration, function() use ($itemid) {
                return json_encode(SteamWorkshop::querySteamData($itemid));
            }));
        } else if ($cache_driver === 'redis') {

        } else {
            return SteamWorkshop::querySteamData($itemid);
        }
    }

    /**
     * @param $group
     * @return mixed
     */
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

    /**
     * @param $key
     * @param $addr
     * @return mixed
     */
    public static function cachedSteamServer($key, $addr)
    {
        $cache_driver = env('CACHE_DRIVER', null);
        $cache_duration = env('CACHE_DURATION', 123);

        if ($cache_driver === 'db') {
            return json_decode(CacheModel::remember('steam_server_' . $addr, $cache_duration, function() use ($key, $addr) {
                return json_encode(SteamServer::querySteamData($key, $addr));
            }));
        } else if ($cache_driver === 'redis') {

        } else {
            return SteamServer::querySteamData($key, $addr);
        }
    }
}
