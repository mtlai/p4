@extends('_master')

@section('title')
	Search (Ajax)
@stop

@section('content')

	<h1>Search (with Ajax!)</h1>

	<label for='query'>Search:</label>
	<input type='text' id='query' name='query' value='novel'><br><br>

	{{ Form::token() }}

	<button id='search-json'>Search and get JSON back</button><br><br>

	<button id='search-html'>Search and get HTML back</button>

	<div id='results'></div>

@stop

@section('/body')
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script src="/js/search.js"></script>
@stop