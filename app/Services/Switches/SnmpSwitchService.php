<?php
/**
 * Created by PhpStorm.
 * User: box
 * Date: 06.12.18
 * Time: 18:48
 */

namespace App\Services\Switches;


use App\Repositories\Switches\SwitchRepository;

/**
 * Class SnmpSwitchService
 * @package App\Services\Switches
 */
class SnmpSwitchService
{
    /**
     * @var SwitchRepository
     */
    protected $switchRepository;

    public function __construct(SwitchRepository $switchRepository)
    {
        $this->switchRepository = $switchRepository;
    }

    public function getAllStatuses()
    {
        $result = [];
        $switches = $this->switchRepository->getAll();
        dd($switches);

        return $result;
    }
}