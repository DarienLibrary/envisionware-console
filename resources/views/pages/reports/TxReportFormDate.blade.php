@extends('app')

@section('customcss')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/daterangepicker.css') }}"/>
@stop

@section('content')

    <h3>{{ $formDesc }}</h3>

    <hr/>
    <div class="row">
        <div class="col-sm-4">

            {!! Form::open(array('url' => 'reportdisplay/tx/' . $formName)) !!}
            <div class="form-group">
                {!! Form::label('Start Date: ') !!}
                {!! Form::text('startDate', null, ['class' => 'form-control', 'placeholder' => 'YYYY-MM-DD', 'id' => 'datepicker']) !!}
                <br/>
                {!! Form::label('End Date: ') !!}
                {!! Form::text('endDate', null, ['class' => 'form-control', 'placeholder' => 'YYYY-MM-DD']) !!}
                <br/>
                {!! Form::submit('Submit', ['class' => 'btn btn-primary form-control']) !!}
            </div>
            {!! Form::hidden('formDesc', $formDesc) !!}
            {!! Form::close() !!}

        </div>
    </div>

@stop

@section('customscripts')

    <script type="text/javascript" src="{{ asset('js/moment.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/daterangepicker.js') }}"></script>

    <script type="text/javascript">
        $(function () {
            $('input[name="startDate"]').daterangepicker({
                locale: {
                    format: 'YYYY-MM-DD'
                },
                singleDatePicker: true,
                showDropdowns: false
            }),
            $('input[name="endDate"]').daterangepicker({
                locale: {
                    format: 'YYYY-MM-DD'
                },
                singleDatePicker: true,
                //timePicker: true,
                showDropdowns: false
            });
        });
    </script>

@stop