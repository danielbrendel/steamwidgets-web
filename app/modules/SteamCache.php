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
        $cache = config('cache');
        
        if ($cache->driver === 'db') {
            return json_decode(CacheModel::remember('steam_app_' . $appid . '_' . $lang, $cache->duration, function() use ($appid, $lang) {
                return json_encode(SteamApp::querySteamData($appid, $lang));
            }));
        } else if ($cache->driver === 'redis') {
            $data = RedisClient::query('steam_app_' . $appid . '_' . $lang);
            if ($data === null) {
                $data = json_encode(SteamApp::querySteamData($appid, $lang));
                RedisClient::save('steam_app_' . $appid . '_' . $lang, $data);
            }

            return json_decode($data);
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
        $cache = config('cache');

        if ($cache->driver === 'db') {
            return json_decode(CacheModel::remember('steam_user_' . $steamid, $cache->duration, function() use ($key, $steamid) {
                return json_encode(SteamUser::querySteamData($key, $steamid));
            }));
        } else if ($cache->driver === 'redis') {
            $data = RedisClient::query('steam_user_' . $steamid);
            if ($data === null) {
                $data = json_encode(SteamUser::querySteamData($key, $steamid));
                RedisClient::save('steam_user_' . $steamid, $data);
            }

            return json_decode($data);
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
        $cache = config('cache');

        if ($cache->driver === 'db') {
            return json_decode(CacheModel::remember('steam_workshop_' . $itemid, $cache->duration, function() use ($itemid) {
                return json_encode(SteamWorkshop::querySteamData($itemid));
            }));
        } else if ($cache->driver === 'redis') {
            $data = RedisClient::query('steam_workshop_' . $itemid);
            if ($data === null) {
                $data = json_encode(SteamWorkshop::querySteamData($itemid));
                RedisClient::save('steam_workshop_' . $itemid, $data);
            }

            return json_decode($data);
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
        $cache = config('cache');

        if ($cache->driver === 'db') {
            return json_decode(CacheModel::remember('steam_group_' . $group, $cache->duration, function() use ($group) {
                return json_encode(SteamGroup::querySteamData($group));
            }));
        } else if ($cache->driver === 'redis') {
            $data = RedisClient::query('steam_group_' . $group);
            if ($data === null) {
                $data = json_encode(SteamGroup::querySteamData($group));
                RedisClient::save('steam_group_' . $group, $data);
            }

            return json_decode($data);
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
        $cache = config('cache');

        if ($cache->driver === 'db') {
            return json_decode(CacheModel::remember('steam_server_' . $addr, $cache->duration, function() use ($key, $addr) {
                return json_encode(SteamServer::querySteamData($key, $addr));
            }));
        } else if ($cache->driver === 'redis') {
            $data = RedisClient::query('steam_server_' . $addr);
            if ($data === null) {
                $data = json_encode(SteamServer::querySteamData($key, $addr));
                RedisClient::save('steam_server_' . $addr, $data);
            }

            return json_decode($data);
        } else {
            return SteamServer::querySteamData($key, $addr);
        }
    }
}
