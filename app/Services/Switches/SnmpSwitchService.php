<?php
/**
 * Created by PhpStorm.
 * User: box
 * Date: 06.12.18
 * Time: 18:48
 */

namespace App\Services\Switches;


use App\Models\Switches\SnmpSwitch;
use App\Repositories\Switches\SwitchConfigRepository;
use App\Repositories\Switches\SwitchConnectionRepository;

/**
 * Class SnmpSwitchService
 * @package App\Services\Switches
 */
class SnmpSwitchService
{
    /**
     * @var SwitchConfigRepository
     */
    protected $switchConfigRepository;

    /**
     * @var SwitchConnectionRepository
     */
    protected $switchConnectionRepository;

    public function __construct(SwitchConfigRepository $switchConfigRepository, SwitchConnectionRepository $switchConnectionRepository)
    {
        $this->switchConfigRepository = $switchConfigRepository;
        $this->switchConnectionRepository = $switchConnectionRepository;
    }

    /**
     * @return array
     * @throws \App\Exceptions\Collections\NotAllowedTypeException
     */
    public function getAllStatuses()
    {
        $result = [];

        $switchConfigCollection = $this->switchConfigRepository->getAllEnabled();

        $switchConnectionCollection = $this->switchConnectionRepository->connectTo($switchConfigCollection);

        foreach ($switchConnectionCollection as $switchConnection) {
            $result[] = SnmpSwitch::create(
                $switchConnection->getSwitchConfig(),
                $switchConnection->getSwitchStatus(),
                $switchConnection->getPortsStatus()
            );
        }


        return $result;
    }
}