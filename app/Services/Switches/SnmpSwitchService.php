<?php
/**
 * Created by PhpStorm.
 * User: box
 * Date: 06.12.18
 * Time: 18:48
 */

namespace App\Services\Switches;


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

    public function getAllStatuses()
    {
        $result = [];

        $switchConfigCollection = $this->switchConfigRepository->getAllEnabled();

        $switchConnectionCollection = $this->switchConnectionRepository->connectTo($switchConfigCollection);

        dd($switchConnectionCollection);
        return $result;
    }
}