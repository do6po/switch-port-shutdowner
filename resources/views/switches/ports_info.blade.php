<?php
/** @var \App\Models\Switches\SwitchPortStatus[] $portStatuses */
?>

<table class="table table-bordered table-striped table-hover">
    <tbody>
    @foreach ($portStatuses as $portStatus)
        <tr>
            <td>
                {{ $portStatus->getPortIndex() }}
            </td>
            <td class="col-3 {{ $portStatus->isUp() ? 'table-success' : 'table-danger' }}">

            </td>
        </tr>
    @endforeach
    </tbody>
</table>
