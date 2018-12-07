<?php

namespace App\Models\Switches;

use \SNMP;

class SwitchConfig
{
    const ENABLED = true;

    const DISABLED = false;

    public $name = '';

    public $ip = '';

    public $snmpCommunity = 'private';

    public $snmpVersion = SNMP::VERSION_2c;

    public $timeout = 1000000; //microseconds

    protected $processedPorts = [];

    protected $enabled = false;

    protected $oidIfOperStatus = '.1.3.6.1.2.1.2.2.1.7';
    protected $oidSysUpTime = '.1.3.6.1.2.1.1.3.0';

    protected function __construct()
    {

    }

    public static function createByConfig(array $config): self
    {
        $switchConfig = new self;
        $switchConfig->name = $config['name'];
        $switchConfig->ip = $config['ip'];
        $switchConfig->processedPorts = $config['processedPorts'];
        $switchConfig->enabled = $config['enabled'];

        if (isset($config['snmpCommunity'])) {
            $switchConfig->snmpCommunity = $config['snmpCommunity'];
        }

        if (isset($config['snmpVersion'])) {
            $switchConfig->snmpVersion = $config['snmpVersion'];
        }

        if (isset($config['timeout'])) {
            $switchConfig->timeout = $config['timeout'];
        }

        return $switchConfig;
    }

    public function isEnabled(): bool
    {
        return $this->enabled === self::ENABLED;
    }

    public function getPortForProcessing(): array
    {
        return $this->processedPorts;
    }

    public function getOidIfOperStatus(): string
    {
        return $this->oidIfOperStatus;
    }

    public function getOidSysUpTime(): string
    {
        return $this->oidSysUpTime;
    }
}
