@extends('app')

@section('content')
    WD Report goes here....!
    <hr />

    {!! Form::open(array('url' => 'foo/bar')) !!}
    //
    {!! Form::close() !!}

@stop