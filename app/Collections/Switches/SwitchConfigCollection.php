<?php
/**
 * Created by PhpStorm.
 * User: box
 * Date: 07.12.18
 * Time: 8:14
 */

namespace App\Collections\Switches;


use App\Collections\NamedCollection;
use App\Models\Switches\SwitchConfig;

class SwitchConfigCollection extends NamedCollection
{
    protected $name = SwitchConfig::class;
}