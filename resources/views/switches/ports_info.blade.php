<?php
/** @var \App\Models\Switches\SwitchPortStatus[] $portStatuses */
?>

<table class="table table-bordered table-striped table-hover">
    <tbody>
    @foreach ($portStatuses as $portStatus)
        <tr class="font-weight-bold">
            <td class="col-6">
                {{ $portStatus->getPortIndex() }}
            </td>
            <td class="col-6 {{ $portStatus->isUp() ? 'bg-success' : 'bg-danger' }}">
                    {{ $portStatus->isUp() ? 'Up' : 'Down' }}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
