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

    public function index()
    {
        return view('switches.index', [

        ]);
    }

    public function down(Request $request)
    {
        return redirect()->route('index', $request->all());
    }

    public function up(Request $request)
    {
        return redirect()->route('index', $request->all());
    }
}
