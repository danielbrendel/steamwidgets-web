<?php

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
     * @param $appid
     * @param $lang
     * @return mixed
     * @throws \Exception
     */
    public static function querySteamData($key, $steamid)
    {
        $url = self::STEAM_ENDPOINT . "?key={$key}&steamids={$steamid}";
        
        $handle = curl_init($url);

        curl_setopt($handle, CURLOPT_HEADER, false);
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($handle, CURLOPT_FOLLOWLOCATION, true);

        $response = curl_exec($handle);

        if(curl_error($handle) !== '') {
            throw new \Exception('cURL error occured');
        }

        curl_close($handle);

        $obj = json_decode($response);
        
        if (isset($obj->response->players[0])) {
            return $obj->response->players[0];
        }

        throw new \Exception('Invalid data response');
    }
}
