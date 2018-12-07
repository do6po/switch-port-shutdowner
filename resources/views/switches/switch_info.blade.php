<?php
/** @var \App\Models\Switches\SwitchConfig $config */
?>

<table class="table table-bordered">
    <tr>
        <td>
            {{ __('Name') }}
        </td>
        <td>
            {{ $config->name }}
        </td>
    </tr>
    <tr>
        <td>
            {{ __('Ip Address') }}
        </td>
        <td>
            {{ $config->ip }}
        </td>
    </tr>
</table>