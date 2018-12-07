<?php
/**
 * Created by PhpStorm.
 * User: box
 * Date: 06.12.18
 * Time: 19:09
 */
?>

@extends('layout.main')
@section('content')
    <div class="card mt-2">
        <div class="card-header">
            {{ __('Must be done') }}
        </div>
        <div class="card-body">
            <a
                    class="btn btn-success"
                    href="{{ url()->route('up', $params)}}"
                    onclick="return confirm('Are you sure want take all pots to UP?')"
            >
                Up all ports
            </a>
            <a
                    class="btn btn-danger"
                    href="{{ url()->route('down', $params)}}"
                    onclick="return confirm('Are you sure want take all pots to Down?')"
            >
                Down all ports
            </a>
        </div>
    </div>
@endsection