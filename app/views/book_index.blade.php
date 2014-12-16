@extends('_master')

@section('title')
	Books
@stop

@section('content')

	<h1>Books</h1>

	<div>
		View as:
		<a href='/book/?format=json' target='_blank'>JSON</a> |
		<a href='/book/?format=pdf' target='_blank'>PDF</a>
	</div>


	@if($query)
		<h2>You searched for {{{ $query }}}</h2>
	@endif

	@if(sizeof($books) == 0)
		No results
	@else

		@foreach($books as $book)
			<section class='book'>

				<h2>{{ $book['title'] }}</h2>

				<p>
					<a href='/book/edit/{{$book['id']}}'>Edit</a>
				</p>

				<p>
					{{ $book['author']['name'] }} ({{$book['published']}})
				</p>

				<p>
					@foreach($book['tags'] as $tag)
						<span class='tag'>{{{ $tag->name }}}</span>
					@endforeach
				</p>

				<img src='{{ $book['cover'] }}'>
				<br>
				<a href='{{ $book['purchase_link'] }}'>Purchase...</a>
			</section>
		@endforeach

	@endif

@stop







