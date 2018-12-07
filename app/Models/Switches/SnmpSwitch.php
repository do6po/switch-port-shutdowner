<?php
/**
 * Created by PhpStorm.
 * User: box
 * Date: 07.12.18
 * Time: 13:46
 */

namespace App\Models\Switches;


class SnmpSwitch
{
    /**
     * @var SwitchConfig
     */
    protected $switchConfig;

    /**
     * @var SwitchStatus
     */
    protected $status;

    /**
     * @var SwitchPortStatus[]
     */
    protected $ports;

    public function getStatus()
    {
        return $this->status;
    }

    public function getPorts()
    {
        return $this->ports;
    }

    public static function create(
        SwitchConfig $switchConfig,
        SwitchStatus $switchStatus,
        array $portStatus
    ): self
    {
        $self = new self();

        $self->switchConfig = $switchConfig;
        $self->status = $switchStatus;
        $self->ports = $portStatus;

        return $self;
    }
}