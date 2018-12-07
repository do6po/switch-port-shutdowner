<?php
/**
 * Created by PhpStorm.
 * User: box
 * Date: 07.12.18
 * Time: 8:05
 */

namespace App\Repositories\Switches;


use App\Collections\Switches\SwitchCollection;
use App\Models\Switches\SwitchConfig;

class SwitchRepository
{
    public function getAll(): SwitchCollection
    {
        $switchArray = config('switches');

        return $this->map($switchArray);
    }

    private function map(array $switchArray)
    {
        $result = [];

        foreach ($switchArray as $switch) {
            $result[] = SwitchConfig::createByConfig($switch);
        }

        return new SwitchCollection($result);
    }
}