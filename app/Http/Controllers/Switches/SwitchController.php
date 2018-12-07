<?php

namespace App\Http\Controllers\Switches;

use App\Http\Middleware\Auth\TokenAuth;
use App\Services\Auth\TokenService;
use App\Http\Controllers\Controller;
use App\Services\Switches\SnmpSwitchService;
use Illuminate\Http\Request;

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

    public function __construct(SnmpSwitchService $snmpSwitchService)
    {
        $this->middleware(TokenAuth::class);

        $this->snmpSwitchService = $snmpSwitchService;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \App\Exceptions\Collections\NotAllowedTypeException
     */
    public function index(Request $request)
    {
        $snmpSwitches = $this->snmpSwitchService->getAllStatuses();
        return view('switches.index', [
            'params' => $request->all(),
            'snmpSwitches' => $snmpSwitches,
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function down(Request $request)
    {
        return redirect()
            ->route('index', $request->all());
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function up(Request $request)
    {
        return redirect()
            ->route('index', $request->all());
    }
}
