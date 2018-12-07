<?php

namespace App\Http\Controllers\Switches;

use App\Http\Requests\Switches\HandlerRequest;
use App\Services\Auth\TokenService;
use App\Http\Controllers\Controller;
use App\Services\Switches\SnmpSwitchService;

class SwitchController extends Controller
{
    /**
     * @var TokenService
     */
    protected $tokenService;

    /**
     * @var SnmpSwitchService
     */
    protected $snmpSwitchService;

    public function __construct(TokenService $tokenService, SnmpSwitchService $snmpSwitchService)
    {
        $this->tokenService = $tokenService;
        $this->snmpSwitchService = $snmpSwitchService;
    }

    public function down(HandlerRequest $request)
    {
        $this->tokenService->validate($request);

        return view('switches.processed', [
//            'log' => $log,
        ]);
    }

    public function up(HandlerRequest $request)
    {
        $log = 'all in up';

        return view('switches.processed', [
            'log' => $log,
        ]);
    }
}
