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
    }

    public function established(): bool
    {
        try {
            return (bool)$this->connection->get(
                $this->switchConfig->getOidSysUpTime()
            );
        } catch (\Exception $exception) {
            return false;
        }
    }

    /**
     * Generate Oid for changing port to up
     *
     * @param int $port
     * @return bool
     */
    public function setIfOperStatusDownUp(int $port): bool
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
     * @return bool
     */
    public function getIfOperStatus(int $port): bool
    {
        $oid = sprintf('%s.%s', $this->switchConfig, $port);
        return $this->connection->get($oid);
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

    /**
     * @param int $port
     * @return bool
     */
    public function isPortDown(int $port): bool
    {
        return $this->getIfOperStatus($port) == SwitchPortStatus::DOWN;
    }

    /**
     * @param int $port
     * @return bool
     */
    public function isPortUp(int $port): bool
    {
        return $this->getIfOperStatus($port) == SwitchPortStatus::UP;
    }

}