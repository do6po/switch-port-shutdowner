<?php
/**
 * Created by PhpStorm.
 * User: box
 * Date: 07.12.18
 * Time: 12:03
 */

namespace App\Models\Switches;
use \SNMP;

/**
 * Class SwitchConnection
 * @package App\Models\Switches
 */
class SwitchConnection
{
    /**
     * @var SNMP
     */
    protected $connection;

    /**
     * @param SwitchConfig $switchConfig
     * @return SwitchConnection
     */
    public static function connect(SwitchConfig $switchConfig)
    {
        $connection = new self;
        $connection->connection = new SNMP(
            $switchConfig->snmpVersion,
            $switchConfig->ip,
            $switchConfig->snmpCommunity,
            $switchConfig->timeout
        );

        return $connection;
    }


    public function isConnected(): bool
    {
        return true;
    }

    /**
     * Generate Oid for changing port to up
     *
     * @param int $port
     * @return bool
     */
    public function up(int $port): bool
    {
        return $port;
    }

    /**
     * Generate Oid for changing port to down
     *
     * @param int $port
     * @return string
     */
    public function down(int $port): string
    {
        return $port;
    }

    /**
     * @param int $port
     * @return bool
     */
    public function ifOperStatus(int $port): bool
    {
        return true;
    }

    /**
     * @param int $port
     * @return bool
     */
    public function isPortDown(int $port): bool
    {
        return true;
    }

    /**
     * @param int $port
     * @return bool
     */
    public function isPortUp(int $port): bool
    {
        return true;
    }

}