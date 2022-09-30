<?php

/**
 * Class SteamGroup
 * 
 * Responsible for querying Steam group data
 */
class SteamGroup
{
    const STEAM_ENDPOINT_ID = 'https://steamcommunity.com/gid/UNIQUE_GROUP_ID64/memberslistxml/?xml=1';
    const STEAM_ENDPOINT_NAME = 'https://steamcommunity.com/groups/UNIQUE_GROUP_NAME/memberslistxml/?xml=1';

    /**
     * Query item data from Steam group
     * 
     * @param $group
     * @return mixed
     * @throws \Exception
     */
    public static function querySteamData($group)
    {
        $url = '';

        if (is_numeric($group)) {
            $url = str_replace('UNIQUE_GROUP_ID64', $group, self::STEAM_ENDPOINT_ID);
        } else {
            $url = str_replace('UNIQUE_GROUP_NAME', $group, self::STEAM_ENDPOINT_NAME);
        }

        $content = simplexml_load_file($url);
        if ($content !== false) {
            $result = new \stdClass();
            $result->groupID64 = intval($content->groupID64->__toString());
            $result->groupName = $content->groupDetails->groupName->__toString();
            $result->groupURL = $content->groupDetails->groupURL->__toString();
            $result->groupHeadline = $content->groupDetails->headline->__toString();
            $result->groupSummary = $content->groupDetails->summary->__toString();
            $result->groupAvatar = $content->groupDetails->avatarFull->__toString();
            $result->members = new \stdClass();
            $result->members->count = intval($content->groupDetails->memberCount->__toString());
            $result->members->in_chat = intval($content->groupDetails->membersInChat->__toString());
            $result->members->in_game = intval($content->groupDetails->membersInGame->__toString());
            $result->members->online = intval($content->groupDetails->membersOnline->__toString());

            return $result;
        }

        return null;
    }
}
