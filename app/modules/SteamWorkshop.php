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
     * @param $appid
     * @param $lang
     * @return mixed
     * @throws \Exception
     */
    public static function querySteamData($itemid)
    {
        $handle = curl_init(self::STEAM_ENDPOINT);

        curl_setopt($handle, CURLOPT_HEADER, false);
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($handle, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($handle, CURLOPT_POST, true);
        curl_setopt($handle, CURLOPT_POSTFIELDS, "itemcount=1&publishedfileids[0]={$itemid}");

        $response = curl_exec($handle);

        if(curl_error($handle) !== '') {
            throw new \Exception('cURL error occured');
        }

        curl_close($handle);

        $obj = json_decode($response);
        
        if ((isset($obj->response->result)) && ($obj->response->result) && (isset($obj->response->resultcount)) && ($obj->response->resultcount == 1)) {
            $obj->response->publishedfiledetails[0]->creator_data = null;

            try {
                $obj->response->publishedfiledetails[0]->creator_data = SteamUser::querySteamData(env('STEAM_API_KEY'), $obj->response->publishedfiledetails[0]->creator);
            } catch (\Exception $e) {
            }
            
            return $obj->response->publishedfiledetails[0];
        }

        throw new \Exception('Invalid data response');
    }
}
