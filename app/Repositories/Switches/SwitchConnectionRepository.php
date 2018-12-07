<?php
/**
 * Created by PhpStorm.
 * User: box
 * Date: 07.12.18
 * Time: 12:56
 */

namespace App\Repositories\Switches;


use App\Collections\Switches\SwitchConfigCollection;
use App\Collections\Switches\SwitchConnectionCollection;
use App\Models\Switches\SwitchConnection;

class SwitchConnectionRepository
{
    /**
     * @param SwitchConfigCollection $switchConfigCollection
     * @return SwitchConnectionCollection|SwitchConnection[]
     * @throws \App\Exceptions\Collections\NotAllowedTypeException
     */
    public function connectTo(SwitchConfigCollection $switchConfigCollection): SwitchConnectionCollection
    {
        $result = [];

        foreach ($switchConfigCollection as $switchConfig) {
            $result[] = SwitchConnection::create($switchConfig);
        }

        return new SwitchConnectionCollection($result);
    }
}