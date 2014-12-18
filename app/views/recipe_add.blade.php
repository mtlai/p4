@extends('_master')

@section('title')
	Add a new recipe
@stop

@section('content')
<br><br><br>
	<h1>Add a new recipe</h1>

	{{ Form::open(array('url' => '/recipe/create', 'files' => true)) }}

		{{ Form::label('title','Title') }}
		{{ Form::text('title'); }}
		
		<br>
		{{ Form::label('author_id', 'Author') }}
		{{ Form::select('author_id', $authors); }}
		
		<br>	
		{{ Form::label('published','Published Year (YYYY)') }}
		{{ Form::text('published'); }}
		
		<br>
		{{ Form::label('ingredients','Ingredients') }}
		{{ Form::textarea('ingredients'); }}
		
		<br>
		{{ Form::label('instructions','Instructions') }}
		{{ Form::textarea('instructions'); }}

		<br>
		{{ Form::label('image_file_name','Instructions') }}
		{{ Form::file('image_file_name')}}


		<br>
		{{ Form::label('cover','External Image URL') }}
		{{ Form::text('cover'); }}

		<br>
		{{ Form::label('credit_url','Credit URL') }}
		{{ Form::text('credit_url'); }}
		
		<br>
		@foreach($tags as $id => $tag)
			{{ Form::checkbox('tags[]', $id); }} {{ $tag }}
		@endforeach

		{{ Form::submit('Add'); }}

	{{ Form::close() }}

@stop
