<?php

/**
 * Class SteamApp
 * 
 * Responsible for querying Steam game/app data
 */
class SteamApp
{
    const STEAM_ENDPOINT = 'https://store.steampowered.com/api/appdetails';

    /**
     * Query item data from Steam
     * 
     * @param $appid
     * @param $lang
     * @return mixed
     * @throws \Exception
     */
    public static function querySteamData($appid, $lang)
    {
        // Check if data is cached
        $cacheKey = 'steam_app_' . $appid . '_' . $lang;
        $cachedData = self::getFromCache($cacheKey);
        if ($cachedData !== false) {
            return $cachedData;
        }

        $url = self::STEAM_ENDPOINT . "?appids={$appid}&l={$lang}";

        $handle = curl_init($url);

        curl_setopt($handle, CURLOPT_HEADER, false);
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($handle, CURLOPT_FOLLOWLOCATION, true);

        $response = curl_exec($handle);

        $curl_error = curl_error($handle);
        if($curl_error !== '') {
            throw new \Exception('cURL error occured: ' . $curl_error);
        }

        curl_close($handle);

        $obj = json_decode($response);
        
        if ((isset($obj->$appid->success)) && ($obj->$appid->success)) {
            $obj->$appid->data->online_count = 0;
            $obj->$appid->data->rating_count = 0;

            try {
                $obj->$appid->data->online_count = static::queryUserCount($appid);
            } catch (\Exception $e) {
            }

            try {
                $obj->$appid->data->rating_count = static::queryRating($appid);
            } catch (\Exception $e) {
            }

            // Store data in cache
            self::setToCache($cacheKey, $obj->$appid->data);

            return $obj->$appid->data;
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

    /**
     * Query Steam product player/user count
     * 
     * @param $appid
     * @return mixed
     * @throws \Exception
     */
    public static function queryUserCount($appid)
    {
        $url = "https://api.steampowered.com/ISteamUserStats/GetNumberOfCurrentPlayers/v1/?appid={$appid}";

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
        
        if ((isset($obj->response->result)) && ($obj->response->result)) {
            return $obj->response->player_count;
        }

        throw new \Exception('Invalid data response');
    }

    /**
     * Query user rating
     * 
     * @param $appid
     * @return int
     */
    public static function queryRating($appid)
    {
        $url = "https://store.steampowered.com/app/{$appid}/?l=english";

        $handle = curl_init($url);

        curl_setopt($handle, CURLOPT_HEADER, false);
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($handle, CURLOPT_FOLLOWLOCATION, true);

        $response = curl_exec($handle);

        if(curl_error($handle) !== '') {
            throw new \Exception('cURL error occurred');
        }

        curl_close($handle);

        $metacode = '<meta itemprop="ratingValue" content="';
        $metaitem = strpos($response, $metacode);
        if ($metaitem !== false) {
            $metaitem += strlen($metacode);

            $rating = '';
            for ($i = $metaitem; $i < strlen($response); $i++) {
                if (substr($response, $i, 1) === '"') {
                    break;
                }

                $rating .= substr($response, $i, 1);
            }

            return intval($rating);
        }

        return 0;
    }
}
