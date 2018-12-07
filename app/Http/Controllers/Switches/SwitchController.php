<?php

namespace App\Http\Controllers\Switches;

use App\Http\Middleware\Auth\TokenAuth;
use App\Repositories\Switches\SwitchConfigRepository;
use App\Services\Switches\SwitchConnectionService;
use App\Http\Controllers\Controller;
use App\Services\Switches\SnmpSwitchService;
use Illuminate\Http\Request;

class SwitchController extends Controller
{
    /**
     * @var SnmpSwitchService
     */
    protected $snmpSwitchService;

    /**
     * @var SwitchConfigRepository
     */
    protected $switchConfigRepository;

    /**
     * @var SwitchConnectionService
     */
    protected $switchConnectionService;

    public function __construct(
        SnmpSwitchService $snmpSwitchService,
        SwitchConnectionService $switchConnectionService,
        SwitchConfigRepository $switchConfigRepository
    )
    {
        $this->middleware(TokenAuth::class);

        $this->snmpSwitchService = $snmpSwitchService;
        $this->switchConnectionService = $switchConnectionService;
        $this->switchConfigRepository = $switchConfigRepository;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \App\Exceptions\Collections\NotAllowedTypeException
     * @throws \App\Exceptions\Collections\NotFoundClassException
     */
    public function index(Request $request)
    {
        $switchConfigs = $this->switchConfigRepository->getAllEnabled();
        $switchConnections = $this->switchConnectionService->connectTo($switchConfigs);
        $snmpSwitches = $this->snmpSwitchService->getSnmpSwitches($switchConnections);

        return view('switches.index', [
            'params' => $request->all(),
            'snmpSwitches' => $snmpSwitches,
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \App\Exceptions\Collections\NotAllowedTypeException
     * @throws \App\Exceptions\Collections\NotFoundClassException
     */
    public function down(Request $request)
    {
        $switchConfigs = $this->switchConfigRepository->getAllEnabled();
        $switchConnections = $this->switchConnectionService->connectTo($switchConfigs);

        $this->snmpSwitchService->setDown($switchConnections);

        return redirect()
            ->route('index', $request->all());
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \App\Exceptions\Collections\NotAllowedTypeException
     * @throws \App\Exceptions\Collections\NotFoundClassException
     */
    public function up(Request $request)
    {
        $switchConfigs = $this->switchConfigRepository->getAllEnabled();
        $switchConnections = $this->switchConnectionService->connectTo($switchConfigs);

        $this->snmpSwitchService->setUp($switchConnections);

        return redirect()
            ->route('index', $request->all());
    }
}
