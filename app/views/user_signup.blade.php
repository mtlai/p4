@extends('_master')

@section('title')
	Log in
@stop

@section('content')
<h1>Sign up</h1>

@foreach($errors->all() as $message)
	<div class='error'>{{ $message }}</div>
@endforeach

{{ Form::open(array('url' => '/signup')) }}

	<br>
 	{{ Form::label('First Name') }}
    {{ Form::text('first_name', '', array('class'=>'form-control')); }}
	<br>
    {{ Form::label('Last Name') }}
    {{ Form::text('last_name', '', array('class'=>'form-control')); }}
	<br>
    {{ Form::label('email') }}
    {{ Form::text('email', '', array('class'=>'form-control')); }}
	<br>
    {{ Form::label('password') }}
    {{ Form::password('password') }}
    <small>Min 6 characters</small>
	<br>
    {{ Form::submit('Submit') }}

{{ Form::close() }}
@stop