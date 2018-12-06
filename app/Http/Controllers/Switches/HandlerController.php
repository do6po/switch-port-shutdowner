<?php

namespace App\Http\Controllers\Switches;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HandlerController extends Controller
{
    public function down(Request $request)
    {
        $log = 'all in down';
        return view('switches.processed', [
            'log' => $log,
        ]);
    }

    public function up(Request $request)
    {
        $log = 'all in up';

        return view('switches.processed', [
            'log' => $log,
        ]);
    }
}
