<?php

/**
 * Class RedisClient
 * 
 * Gateway to Redis service
 */
class RedisClient {
    /**
     * @return Predis\Client
     */
    public static function redis()
    {
        return new Predis\Client([
            'scheme' => env('REDIS_SCHEME', 'tcp'),
            'host'   => env('REDIS_HOST', '10.0.0.1'),
            'port'   => env('REDIS_PORT', 6379)
        ]);
    }

    /**
     * @param $key
     * @param $fallback
     * @return mixed
     */
    public static function query($key, $fallback = null)
    {
        $result = static::redis()->get($key);
        if ($result === null) {
            return $fallback;
        }

        return $result;
    }

    /**
     * @param $key
     * @param $content
     * @return void
     */
    public static function save($key, $content)
    {
        return static::redis()->set($key, $content);
    }
}
