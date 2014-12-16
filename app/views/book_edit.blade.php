@extends('_master')

@section('title')
	Edit
@stop

@section('head')

@stop

@section('content')

	<h1>Edit</h1>
	<h2>{{{ $book['title'] }}}</h2>

	{{---- EDIT -----}}
	{{ Form::open(array('url' => '/book/edit')) }}

		{{ Form::hidden('id',$book['id']); }}

		<div class='form-group'>
			{{ Form::label('title','Title') }}
			{{ Form::text('title',$book['title']); }}
		</div>

		<div class='form-group'>
			{{ Form::label('author_id', 'Author') }}
			{{ Form::select('author_id', $authors, $book->author_id); }}
		</div>

		<div class='form-group'>
			{{ Form::label('published','Published Year (YYYY)') }}
			{{ Form::text('published',$book['published']); }}
		</div>

		<div class='form-group'>
			{{ Form::label('cover','Cover Image URL') }}
			{{ Form::text('cover',$book['cover']); }}
		</div>

		<div class='form-group'>
			{{ Form::label('purchase_link','Purchase Link URL') }}
			{{ Form::text('purchase_link',$book['purchase_link']); }}
		</div>


		<div class='form-group'>
			@foreach($tags as $id => $tag)
				{{ Form::checkbox('tags[]', $id, $book->tags->contains($id)); }} {{ $tag }}
				&nbsp;&nbsp;&nbsp;
			@endforeach
		</div>

		{{ Form::submit('Save'); }}

	{{ Form::close() }}

	<div>
		{{---- DELETE -----}}
		{{ Form::open(array('url' => '/book/delete')) }}
			{{ Form::hidden('id',$book['id']); }}
			<button onClick='parentNode.submit();return false;'>Delete</button>
		{{ Form::close() }}
	</div>


@stop