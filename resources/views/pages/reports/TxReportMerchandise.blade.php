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
            <th>Item Information</th>
            <th class="text-right">Cash</th>
            <th class="text-right">Check</th>
            <th class="text-right">Credit Card</th>
            <th class="text-right">AAM</th>
            <th class="text-right">Total</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($reportDataSet['reportData'] as $lineDescription => $lineTotals)
            <tr class="text-right">
                <td class="text-left">{{ $lineDescription }}</td>
                <td> {{ number_format($lineTotals['CA'], 2) }} </td>
                <td> {{ number_format($lineTotals['CH'], 2) }} </td>
                <td> {{ number_format($lineTotals['CC'], 2) }} </td>
                <td> {{ number_format($lineTotals['AM'], 2) }} </td>
                <td> {{ number_format($lineTotals['total'], 2) }} </td>
            </tr>
        @endforeach
        <tr class="text-right">
            <th>Total</th>
            <td> {{  number_format($reportDataSet['reportTotals']['CA'], 2) }} </td>
            <td> {{  number_format($reportDataSet['reportTotals']['CH'], 2) }} </td>
            <td> {{  number_format($reportDataSet['reportTotals']['CC'], 2) }} </td>
            <td> {{  number_format($reportDataSet['reportTotals']['AM'], 2) }} </td>
            <td> {{  number_format($reportDataSet['reportTotals']['total'], 2) }} </td>
        </tr>
        </tbody>
    </table>

@stop
