@extends('_master')

@section('title')
	Edit
@stop

@section('head')

@stop

@section('content')

	<h1>Edit</h1>
	<h2>{{{ $recipe['title'] }}}</h2>

	{{---- EDIT -----}}
	{{ Form::open(array('url' => '/recipe/edit')) }}

		{{ Form::hidden('id',$recipe['id']); }}

		<div class='form-group'>
			{{ Form::label('title','Title') }}
			{{ Form::text('title',$recipe['title']); }}
		</div>

		<div class='form-group'>
			{{ Form::label('author_id', 'Author') }}
			{{ Form::select('author_id', $authors, $recipe->author_id); }}
		</div>

		<div class='form-group'>
			{{ Form::label('published','Published Year (YYYY)') }}
			{{ Form::text('published',$recipe['published']); }}
		</div>

		<div class='form-group'>
			{{ Form::label('ingredients','Ingredients') }}
			{{ Form::text('ingredients',$recipe['ingredients']); }}
		</div>
		
		<div class='form-group'>
			{{ Form::label('cover','Cover Image URL') }}
			{{ Form::text('cover',$recipe['cover']); }}
		</div>

		<div class='form-group'>
			{{ Form::label('credit_url','Credit URL') }}
			{{ Form::text('credit_url',$recipe['credit_url']); }}
		</div>


		<div class='form-group'>
			@foreach($tags as $id => $tag)
				{{ Form::checkbox('tags[]', $id, $recipe->tags->contains($id)); }} {{ $tag }}
				&nbsp;&nbsp;&nbsp;
			@endforeach
		</div>

		{{ Form::submit('Save'); }}

	{{ Form::close() }}

	<div>
		{{---- DELETE -----}}
		{{ Form::open(array('url' => '/recipe/delete')) }}
			{{ Form::hidden('id',$recipe['id']); }}
			<button onClick='parentNode.submit();return false;'>Delete</button>
		{{ Form::close() }}
	</div>


@stop