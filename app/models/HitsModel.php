<?php

/**
 * Class HitsModel
 * 
 * Responsible for hit calculation
 */ 
class HitsModel extends \Asatru\Database\Model
{
    const HITTYPE_MODULE_APP = 'mod_app';
    const HITTYPE_MODULE_SERVER = 'mod_server';
    const HITTYPE_MODULE_USER = 'mod_user';
    const HITTYPE_MODULE_WORKSHOP = 'mod_workshop';
    const HITTYPE_MODULE_GROUP = 'mod_group';

    /**
     * Validate hit type
     * 
     * @param $type
     * @return void
     * @throws Exception
     */
    public static function validateHitType($type)
    {
        try {
            $types = [self::HITTYPE_MODULE_APP, self::HITTYPE_MODULE_SERVER, self::HITTYPE_MODULE_USER, self::HITTYPE_MODULE_WORKSHOP, self::HITTYPE_MODULE_GROUP];

            if (!in_array($type, $types)) {
                throw new Exception('Invalid hit type: ' . $type);
            }
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Add hit to database
     * 
     * @param $address
     * @param $type
     * @return void
     * @throws Exception
     */
    public static function addHit($type)
    {
        try {
            static::validateHitType($type);

            $token = md5($_SERVER['REMOTE_ADDR']);
            $referrer = (isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '');

            HitsModel::raw('INSERT INTO `' . self::tableName() . '` (hash_token, hittype, referrer, created_at) VALUES(?, ?, ?, CURRENT_TIMESTAMP)', [
                $token,
                $type,
                $referrer
            ]);
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Get all hits of the given range
     * 
     * @param $start
     * @param $end
     * @return Asatru\Database\Collection
     * @throws \Exception
     */
    public static function getHitsPerDay($start, $end)
    {
        try {
            $result = HitsModel::raw('SELECT DATE(created_at) AS created_at, COUNT(hash_token) AS count, hittype FROM `' . self::tableName() . '` WHERE DATE(created_at) >= ? AND DATE(created_at) <= ? GROUP BY DATE(created_at), hittype ORDER BY created_at ASC', [
                $start,
                $end
            ]);

            return $result;
        } catch (\Exception $e) {
            throw $e;
        }
    }

    /**
     * Get all referrers of a given range
     * 
     * @param $start
     * @param $end
     * @return Asatru\Database\Collection
     * @throws \Exception
     */
    public static function getReferrers($start, $end)
    {
        try {
            $items = HitsModel::raw('SELECT DISTINCT referrer, COUNT(referrer) AS count FROM `' . self::tableName() . '` WHERE DATE(created_at) >= ? AND DATE(created_at) <= ? GROUP BY referrer ORDER BY referrer ASC', [
                $start,
                $end
            ]);

            $result = [];

            foreach ($items as $item) {
                $furl = parse_url($item->get('referrer'), PHP_URL_HOST);
                if (!in_array($furl, $result)) {
                    $entry['ref'] = $furl;
                    $entry['count'] = $item->get('count');
                    $result[] = $entry;
                }
            }
            
            return $result;
        } catch (\Exception $e) {
            throw $e;
        }
    }

    /**
     * Get initial start date
     * 
     * @return string
     */
    public static function getInitialStartDate()
    {
        $data = HitsModel::raw('SELECT created_at FROM `' . self::tableName() . '` WHERE id = 1')->first();
        return $data->get('created_at');
    }

    /**
     * Return the associated table name of the migration
     * 
     * @return string
     */
    public static function tableName()
    {
        return 'hits';
    }
}