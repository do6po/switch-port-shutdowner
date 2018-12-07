<?php
/**
 * Created by PhpStorm.
 * User: box
 * Date: 07.12.18
 * Time: 12:57
 */

namespace App\Collections\Switches;


use App\Collections\NamedCollection;
use App\Models\Switches\SwitchConnection;

class SwitchConnectionCollection extends NamedCollection
{
    protected $name = SwitchConnection::class;
}