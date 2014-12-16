@extends('_master')

@section('title')
	Demo of binding JS variables to a view
@stop

@section('content')

	<h1>JavaScript Variable Passing Example</h1>

	<div>
		<button id='ex1'>Get the 'foo' var</button>
		<button id='ex2'>Get the 'email' var</button>
	</div>

@stop

@section('/body')
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

	<script>
		$('#ex1').click(function() {
			alert('The value of `foo` is ' + foo);
		});

		$('#ex2').click(function() {
			alert('The value of `email` is ' + email);
		});
	</script>
@stop