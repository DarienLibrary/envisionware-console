@extends('app')

@section('content')

<div class="bs-callout bs-callout-primary">
    <h4>{{ $input['formDesc'] }}</h4>
    <br/>
    From: {{ $input['startDate'] }} to {{ $input['endDate'] }}
</div>

<table class="table table-striped">
    <thead>
    <tr>
        <th>Transaction ID</th>
        <th>Transaction Time</th>
        <th class="text-right">Transaction Type</th>
        <th class="text-right">Cash</th>
        <th class="text-right">Credit Card</th>
        <th class="text-right">Check</th>
        <th class="text-right">AAM</th>
        <th class="text-right">Change</th>
        <th class="text-right">Line Total</th>
        <th class="text-right">Total</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($reportDataSet as $lineData)
    <tr class="text-right">
        <td class="text-left">{{ $lineData->ControlNo }}</td>
        <td class="text-left">{{ $lineData->TransactionDateTime }}</td>
        <td> {{ $lineData->Description }} </td>
        <td> {{ number_format($lineData->CA, 2) }} </td>
        <td> {{ number_format($lineData->CC, 2) }} </td>
        <td> {{ number_format($lineData->CH, 2) }} </td>
        <td> {{ number_format($lineData->AM, 2) }} </td>
        <td> {{ number_format($lineData->CX, 2) }} </td>
        <td> {{ number_format($lineData->LineTotal, 2) }} </td>
        <td> {{ number_format($lineData->Total, 2) }} </td>
    </tr>
    @endforeach

    </tbody>
</table>

@stop