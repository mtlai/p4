@extends('_master')

@section('title')
	Log in
@stop

@section('content')

<h1>Log in</h1>

{{ Form::open(array('url' => '/login')) }}

    {{ Form::label('email') }}
    {{ Form::text('email','tester@gmail.com', array('class'=>'form-control')); }}
    <br>
    {{ Form::label('password') }} (123456)
    {{ Form::password('password', array('class'=>'form-control')); }}
	<br>
    {{ Form::submit('Submit') }}

{{ Form::close() }}

@stop