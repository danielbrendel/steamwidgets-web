<?php

use Redis;

/**
 * Class SteamUser
 * 
 * Responsible for querying Steam user data
 */
class SteamUser
{
    const STEAM_ENDPOINT = 'https://api.steampowered.com/ISteamUser/GetPlayerSummaries/v2/';

    /**
     * Query item data from Steam
     * 
     * @param $key
     * @param $steamid
     * @return mixed
     * @throws \Exception
     */
    public static function querySteamData($key, $steamid)
    {
        // Generate cache key
        $cacheKey = 'steam_user_' . $steamid;

        // Check if data is cached
        $cachedData = self::getFromCache($cacheKey);
        if ($cachedData !== false) {
            return json_decode($cachedData);
        }

        $url = self::STEAM_ENDPOINT . "?key={$key}&steamids={$steamid}";
        
        $handle = curl_init($url);

        curl_setopt($handle, CURLOPT_HEADER, false);
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($handle, CURLOPT_FOLLOWLOCATION, true);

        $response = curl_exec($handle);

        if(curl_error($handle) !== '') {
            throw new \Exception('cURL error occurred');
        }

        curl_close($handle);

        $obj = json_decode($response);
        
        if (isset($obj->response->players[0])) {
            $userData = $obj->response->players[0];

            // Store data in cache
            self::setToCache($cacheKey, json_encode($userData));

            return $userData;
        }

        throw new \Exception('Invalid data response');
    }

    /**
     * Get data from Redis cache
     *
     * @param $key
     * @return mixed|bool
     */
    private static function getFromCache($key)
    {
        $redis = new Redis();
        $redis->connect(env('REDIS_HOST'), env('REDIS_PORT'));
        $redis->select(env('REDIS_DATABASE')); // Selecting Redis database index 5

        $cachedData = $redis->get($key);
        if ($cachedData !== false) {
            return json_decode($cachedData);
        }

        return false;
    }

    /**
     * Set data to Redis cache
     *
     * @param $key
     * @param $value
     */
    private static function setToCache($key, $value)
    {
        $redis = new Redis();
        $redis->connect(env('REDIS_HOST'), env('REDIS_PORT'));
        $redis->select(env('REDIS_DATABASE')); // Selecting Redis database index 5

        $redis->set($key, json_encode($value), env('REDIS_EXPIRATION'));
    }
}
