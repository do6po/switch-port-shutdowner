<?php
/**
 * Created by PhpStorm.
 * User: box
 * Date: 07.12.18
 * Time: 16:27
 */

namespace App\Collections\Switches;


use App\Collections\NamedCollection;
use App\Models\Switches\SwitchPortStatus;

class SwitchPortCollection extends NamedCollection
{
    protected $class = SwitchPortStatus::class;
}