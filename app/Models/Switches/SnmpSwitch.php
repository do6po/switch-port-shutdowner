<?php

namespace App\Models\Switches;

use \SNMP;

class SnmpSwitch
{
    const OID_IF_ADMIN_STATUS = '.1.3.6.1.2.1.2.2.1.7';

    const UP = 1;

    const DOWN = 2;

    public $name = '';

    public $ip = '';

    public $snmpCommunity = 'private';

    public $snmpVersion = SNMP::VERSION_2c;

    public $timeout = 1000000; //microseconds

    public $processedPorts = [];

    public function __construct()
    {

    }

    public static function createByConfig(array $config): self
    {
        $switch = new self;
        $switch->name = $config['name'];
        $switch->name = $config['ip'];
        $switch->name = $config['snmpCommunity'];
        $switch->name = $config['snmpVersion'];
        $switch->name = $config['timeout'];
        $switch->name = $config['processedPorts'];

        return $switch;
    }

    public function connect(): bool
    {
        return true;
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
    public function isOPortUp(int $port): bool
    {
        return true;
    }
}
