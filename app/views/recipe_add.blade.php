@extends('_master')

@section('title')
	Add a new recipe
@stop

@section('content')
<br><br><br><br>
	<h1>Add a new recipe</h1>
	<div class="maincontent">
	{{ Form::open(array('url' => '/recipe/create', 'files' => true)) }}

		<div class="input-group">
		{{ Form::label('title','Title') }}
		{{ Form::text('title', '', array('class'=>'form-control')); }}
		</div>
		
		
		<br>
		<div class="input-group">
		{{ Form::label('author_id', 'Author') }}
		{{ Form::select('author_id', $authors); }}
		</div>
		
		<br>
		<div class="input-group">
		
		{{ Form::label('published','Published Year (YYYY)') }}
		{{ Form::text('published', '', array('class'=>'form-control')); }}
		
		</div>
		
		<br>
		<div class="input-group">
		{{ Form::label('ingredients','Ingredients') }}
		{{ Form::textarea('ingredients', '', array('class'=>'form-control')); }}
		
		</div>
		
		<br>
		<div class="input-group">
		{{ Form::label('instructions','Instructions') }}
		{{ Form::textarea('instructions', '', array('class'=>'form-control')); }}

		</div>
		
		<br>
		<div class="input-group">
		{{ Form::label('image_file_name','File Name') }}
		{{ Form::file('image_file_name')}}


		</div>
		
		<br>
		<div class="input-group">
		{{ Form::label('cover','External Image URL') }}
		{{ Form::text('cover', '', array('class'=>'form-control')); }}

		</div>
		
		<br>
		<div class="input-group">
		{{ Form::label('credit_url','Credit URL') }}
		{{ Form::text('credit_url', '', array('class'=>'form-control')); }}
		
		</div>
		
		<br>
		<div class="input-group">
		@foreach($tags as $id => $tag)
			{{ Form::checkbox('tags[]', $id); }} {{ $tag }}
		@endforeach
		</div>
		
		<br>
		{{ Form::submit('Add'); }}

	{{ Form::close() }}
	</div>
@stop
