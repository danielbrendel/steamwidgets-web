<?php
/**
 * Class SteamWorkshop
 * 
 * Responsible for querying Steam Workshop data
 */
class SteamWorkshop
{
    const STEAM_ENDPOINT = 'https://api.steampowered.com/ISteamRemoteStorage/GetPublishedFileDetails/v1/';

    /**
     * Query item data from Steam Workshop item
     * 
     * @param $itemid
     * @return mixed
     * @throws \Exception
     */
    public static function querySteamData($itemid)
    {
        // Generate cache key
        $cacheKey = 'steam_workshop_' . $itemid;

        // Check if data is cached
        $cachedData = self::getFromCache($cacheKey);
        if ($cachedData !== false) {
            return json_decode($cachedData);
        }

        $handle = curl_init(self::STEAM_ENDPOINT);

        curl_setopt($handle, CURLOPT_HEADER, false);
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($handle, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($handle, CURLOPT_POST, true);
        curl_setopt($handle, CURLOPT_POSTFIELDS, "itemcount=1&publishedfileids[0]={$itemid}");

        $response = curl_exec($handle);

        if(curl_error($handle) !== '') {
            throw new \Exception('cURL error occurred');
        }

        curl_close($handle);

        $obj = json_decode($response);
        
        if ((isset($obj->response->result)) && ($obj->response->result) && (isset($obj->response->resultcount)) && ($obj->response->resultcount == 1)) {
            $workshopData = $obj->response->publishedfiledetails[0];

            // Store data in cache
            self::setToCache($cacheKey, json_encode($workshopData));

            return $workshopData;
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
        if (env('REDIS_PASS') !== '') {
            $redis->auth(env('REDIS_PASS'));
        }
        $redis->select(env('REDIS_DATABASE')); // Selecting Redis database index
        
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
        if (env('REDIS_PASS') !== '') {
            $redis->auth(env('REDIS_PASS'));
        }
        $redis->select(env('REDIS_DATABASE')); // Selecting Redis database index

        $redis->set($key, json_encode($value), env('REDIS_EXPIRATION'));
    }

}
