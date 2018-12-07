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
     * @var SwitchConfig
     */
    protected $switchConfig;

    /**
     * @param SwitchConfig $switchConfig
     * @return SwitchConnection
     */
    public static function create(SwitchConfig $switchConfig)
    {
        $connection = new self;
        $connection->setSwitchConfig($switchConfig);
        $connection->connect();

        return $connection;
    }

    /**
     * @param SwitchConfig $switchConfig
     */
    protected function setSwitchConfig(SwitchConfig $switchConfig): void
    {
        $this->switchConfig = $switchConfig;
    }

    protected function connect()
    {
        $this->connection = new SNMP(
            $this->switchConfig->snmpVersion,
            $this->switchConfig->ip,
            $this->switchConfig->snmpCommunity,
            $this->switchConfig->timeout
        );

        $this->connection->quick_print = 1;
    }

    public function getSwitchStatus(): SwitchStatus
    {
        try {
            $this->connection->get($this->switchConfig->getOidSysUpTime());

            return SwitchStatus::online();
        } catch (\Exception $exception) {

            return SwitchStatus::offline();
        }
    }

    /**
     * Generate Oid for changing port to up
     *
     * @param int $port
     * @return bool
     */
    public function setIfOperStatusUp(int $port): bool
    {
        return $this->setIfOperStatus($port, SwitchPortStatus::UP);
    }

    /**
     * Generate Oid for changing port to down
     *
     * @param int $port
     * @return string
     */
    public function setIfOperStatusDown(int $port): string
    {
        return $this->setIfOperStatus($port, SwitchPortStatus::DOWN);
    }

    /**
     * @param int $port
     * @param int $status
     * @return bool
     */
    public function setIfOperStatus(int $port, int $status): bool
    {
        $oid = sprintf('%s.%s', $this->switchConfig->getOidIfOperStatus(), $port);

        return $this->connection->set($oid, 'i', $status);
    }

    public function setProcessingPortsDown(): void
    {
        foreach ($this->switchConfig->getPortForProcessing() as $port) {
            $this->setIfOperStatusDown($port);
        }
    }

    public function setProcessingPortsUp(): void
    {
        foreach ($this->switchConfig->getPortForProcessing() as $port) {
            $this->setIfOperStatusUp($port);
        }
    }

    /**
     * @param int $port
     * @return SwitchPortStatus
     */
    public function getPortStatus(int $port): SwitchPortStatus
    {
        $oid = sprintf('%s.%s', $this->switchConfig->getOidIfOperStatus(), $port);

        try {
            return SwitchPortStatus::create($port, $this->connection->get($oid));
        } catch (\Exception $exception) {
            return SwitchPortStatus::create($port, SwitchPortStatus::UNKNOWN);
        }
    }

    /**
     * @return array|SwitchPortStatus[]
     */
    public function getPortsStatus(): array
    {
        $result = [];

        foreach ($this->switchConfig->getPortForProcessing() as $port) {
            $result[] = $this->getPortStatus($port);
        }

        return $result;
    }

    /**
     * @param int $port
     * @return bool
     */
    public function isPortDown(int $port): bool
    {
        return $this->getPortStatus($port) == SwitchPortStatus::DOWN;
    }

    /**
     * @param int $port
     * @return bool
     */
    public function isPortUp(int $port): bool
    {
        return $this->getPortStatus($port) == SwitchPortStatus::UP;
    }


    public function getSwitchConfig(): SwitchConfig
    {
        return $this->switchConfig;
    }
}