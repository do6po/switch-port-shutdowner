<?php
/**
 * Created by PhpStorm.
 * User: box
 * Date: 07.12.18
 * Time: 13:49
 */

namespace App\Collections\Switches;


use App\Collections\NamedCollection;
use App\Models\Switches\SnmpSwitch;

class SnmpSwitchCollection extends NamedCollection
{
    protected $class = SnmpSwitch::class;
}