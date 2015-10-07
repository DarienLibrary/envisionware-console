@extends('app')

@section('customcss')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/daterangepicker.css') }}"/>
@stop

@section('content')

    <h3>Kiosk Transaction Report</h3>
    <hr/>

    <div class="row">
        <div class="col-sm-4">

            {!! Form::open(array('url' => '/reportdisplay/tx/kiosk')) !!}
            <div class="form-group">
                {!! Form::label('Select Service Point: ') !!}
                {!! Form::select('servicePoint', array(
                        'all' => 'All Service Points',
                        env('KIOSK_HOSTNAME_KLS') => 'KLS',
                        env('KIOSK_HOSTNAME_BC') => 'Business Center',
                        env('KIOSK_HOSTNAME_PL') => 'Power Library',
                        env('KIOSK_HOSTNAME_WEB') => 'Web Payment Portal'
                    ), 'all', ['class' => 'form-control'])
                !!}
                <br/>
                {!! Form::label('Starting at: ') !!}
                {!! Form::text('startDate', null, ['class' => 'form-control', 'id' => 'datepicker']) !!}
                <br/>
                {!! Form::label('Ending at: ') !!}
                {!! Form::text('endDate', null, ['class' => 'form-control']) !!}
                <br/>
                {!! Form::submit('Submit', ['class' => 'btn btn-primary form-control']) !!}
            </div>
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
                    format: {!! $useDateAndTime ? "'YYYY-MM-DD HH:MM:SS'" : "'YYYY-MM-DD'" !!}
                },
                singleDatePicker: true,
                timePicker: {!! $useDateAndTime ? 'true' : 'false' !!},
                showDropdowns: false
            }),
                    $('input[name="endDate"]').daterangepicker({
                        locale: {
                            format: {!! $useDateAndTime ? "'YYYY-MM-DD HH:MM:SS'" : "'YYYY-MM-DD'" !!}
                        },
                        singleDatePicker: true,
                        timePicker: {!! $useDateAndTime ? 'true' : 'false' !!},
                        showDropdowns: false
                    });
        });
    </script>

@stop