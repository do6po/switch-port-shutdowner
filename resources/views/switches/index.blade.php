<?php
/**
 * Created by PhpStorm.
 * User: box
 * Date: 06.12.18
 * Time: 19:09
 */

/** @var \App\Models\Switches\SnmpSwitch[] $snmpSwitches */
?>

@extends('layout.main')
@section('content')
    <div class="card mt-2">
        <div class="card-header">
            {{ __('Must be done') }}
        </div>
        <div class="card-body">
            <p>
                <a
                        class="btn btn-success"
                        href="{{ url()->route('up', $params)}}"
                        onclick="return confirm('Are you sure want take all pots to UP?')"
                >
                    {{ __('Up all ports') }}
                </a>
                <a
                        class="btn btn-danger"
                        href="{{ url()->route('down', $params)}}"
                        onclick="return confirm('Are you sure want take all pots to Down?')"
                >
                    {{ __('Down all ports') }}
                </a>
            </p>
            @foreach($snmpSwitches as $snmpSwitch)
                <h3> {{ $snmpSwitch->getConfig()->name }}</h3>

                <div class="row">
                    <div class="col-6">
                        @include('switches.switch_info', [
                            'config' => $snmpSwitch->getConfig(),
                        ])
                    </div>
                    <div class="col-6">
                        @include('switches.ports_info', ['portStatuses' => $snmpSwitch->getPorts()])
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection