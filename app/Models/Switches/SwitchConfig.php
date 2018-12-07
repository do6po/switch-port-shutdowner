<?php

namespace App\Models\Switches;

use \SNMP;

class SwitchConfig
{
    const OID_IF_ADMIN_STATUS = '.1.3.6.1.2.1.2.2.1.7';

    const UP = 1;

    const DOWN = 2;

    const ENABLED = true;

    const DISABLED = false;

    public $name = '';

    public $ip = '';

    public $snmpCommunity = 'private';

    public $snmpVersion = SNMP::VERSION_2c;

    public $timeout = 1000000; //microseconds

    public $processedPorts = [];

    public $enabled = false;

    protected function __construct()
    {

    }

    public static function createByConfig(array $config): self
    {
        $switchConfig = new self;
        $switchConfig->name = $config['name'];
        $switchConfig->name = $config['ip'];
        $switchConfig->name = $config['snmpCommunity'];
        $switchConfig->name = $config['snmpVersion'];
        $switchConfig->name = $config['timeout'];
        $switchConfig->name = $config['processedPorts'];
        $switchConfig->name = $config['enabled'];

        return $switchConfig;
    }

    public function connect(): bool
    {
        return true;
    }

    public function isEnabled(): bool
    {
        return $this->enabled === self::ENABLED;
    }
}
