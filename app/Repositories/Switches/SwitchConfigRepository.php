<?php
/**
 * Created by PhpStorm.
 * User: box
 * Date: 07.12.18
 * Time: 8:05
 */

namespace App\Repositories\Switches;


use App\Collections\Switches\SwitchConfigCollection;
use App\Models\Switches\SwitchConfig;

class SwitchConfigRepository
{
    public function getAll(): SwitchConfigCollection
    {
        $switchArray = config('switches');

        return $this->map($switchArray);
    }

    public function getAllEnabled(): SwitchConfigCollection
    {
        $all = $this->getAll();

        return $all->filter(function(SwitchConfig $switchConfig) {
            return $switchConfig->isEnabled();
        });
    }

    private function map(array $switchArray)
    {
        $result = [];

        foreach ($switchArray as $switch) {
            $result[] = SwitchConfig::createByConfig($switch);
        }

        return new SwitchConfigCollection($result);
    }
}