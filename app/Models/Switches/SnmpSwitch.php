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
     * @var SwitchStatus
     */
    protected $status;

    /**
     * @var SwitchPortStatus
     */
    protected $ports;

    protected $connection;
}