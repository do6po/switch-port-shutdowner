<?php
/**
 * Created by PhpStorm.
 * User: box
 * Date: 06.12.18
 * Time: 18:48
 */

namespace App\Services\Switches;


use App\Collections\Switches\SnmpSwitchCollection;
use App\Collections\Switches\SwitchConnectionCollection;
use App\Models\Switches\SnmpSwitch;
use App\Models\Switches\SwitchConnection;

/**
 * Class SnmpSwitchService
 * @package App\Services\Switches
 */
class SnmpSwitchService
{
    const ACTION_UP = 'up';

    const ACTION_DOWN = 'down';

    /**
     * @param SwitchConnectionCollection $switchConnections
     * @return SnmpSwitchCollection|SwitchConnection[]
     * @throws \App\Exceptions\Collections\NotAllowedTypeException
     * @throws \App\Exceptions\Collections\NotFoundClassException
     */
    public function getSnmpSwitches(SwitchConnectionCollection $switchConnections): SnmpSwitchCollection
    {
        $result = [];

        foreach ($switchConnections as $switchConnection) {
            $result[] = SnmpSwitch::create(
                $switchConnection->getSwitchConfig(),
                $switchConnection->getSwitchStatus(),
                $switchConnection->getPortsStatus()
            );
        }

        return new SnmpSwitchCollection($result);
    }

    /**
     * @param SwitchConnectionCollection $switchConnections
     */
    public function setDown(SwitchConnectionCollection $switchConnections): void
    {
        $this->handleByActionType($switchConnections, self::ACTION_DOWN);
    }

    /**
     * @param SwitchConnectionCollection $switchConnections
     */
    public function setUp(SwitchConnectionCollection $switchConnections): void
    {
        $this->handleByActionType($switchConnections,self::ACTION_UP);
    }

    /**
     * @param SwitchConnectionCollection $switchConnections
     * @param string $actionType
     */
    public function handleByActionType(SwitchConnectionCollection $switchConnections, string $actionType)
    {
        foreach ($switchConnections as $switchConnection) {
            if ($actionType === self::ACTION_DOWN) {
                $switchConnection->setProcessingPortsDown();
            } elseif ($actionType === self::ACTION_UP) {
                $switchConnection->setProcessingPortsUp();
            }
        }
    }
}