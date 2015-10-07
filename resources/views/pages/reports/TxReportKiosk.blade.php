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
            <th>Transaction Date/Time</th>
            <th class="text-right">Description</th>
            <th class="text-right">Cash</th>
            <th class="text-right">AAM</th>
            <th class="text-right">Credit</th>
            <th class="text-right">Total</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($reportDataSet['reportData'] as $lineData)
            <tr class="text-right">
                <td class="text-left">{{ $lineData['time'] }}</td>
                <td> {{ $lineData['desc'] }} </td>
                <td> {{ number_format($lineData['cash'], 2) }} </td>
                <td> {{ number_format($lineData['aam'], 2) }} </td>
                <td> {{ number_format($lineData['credit'], 2) }} </td>
                <td> {{ number_format($lineData['total'], 2) }} </td>
            </tr>
        @endforeach
        <tr class="text-right">
            <th>Total</th>
            <td></td>
            <td> {{  number_format($reportDataSet['reportTotals']['cash'], 2) }} </td>
            <td> {{  number_format($reportDataSet['reportTotals']['aam'], 2) }} </td>
            <td> {{  number_format($reportDataSet['reportTotals']['credit'], 2) }} </td>
            <td> {{  number_format($reportDataSet['reportTotals']['total'], 2) }} </td>
        </tr>
        </tbody>
    </table>

@stop