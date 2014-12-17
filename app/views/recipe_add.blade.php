@extends('_master')

@section('title')
	Add a new recipe
@stop

@section('content')

	<h1>Add a new recipe</h1>

	{{ Form::open(array('url' => '/recipe/create')) }}

		{{ Form::label('title','Title') }}
		{{ Form::text('title'); }}

		{{ Form::label('author_id', 'Author') }}
		{{ Form::select('author_id', $authors); }}

		{{ Form::label('published','Published Year (YYYY)') }}
		{{ Form::text('published'); }}
		
		{{ Form::label('ingredients','Ingredients') }}
		{{ Form::text('ingredients'); }}
		
		{{ Form::label('instructions','Instructions') }}
		{{ Form::text('instructions'); }}


		{{ Form::label('cover','Cover Image URL') }}
		{{ Form::text('cover'); }}

		{{ Form::label('credit_url','Credit URL') }}
		{{ Form::text('credit_url'); }}

		@foreach($tags as $id => $tag)
			{{ Form::checkbox('tags[]', $id); }} {{ $tag }}
		@endforeach

		{{ Form::submit('Add'); }}

	{{ Form::close() }}

@stop
