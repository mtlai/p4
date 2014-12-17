@extends('_master')

@section('title')
	Recipes
@stop

@section('content')

	<h1>Recipes</h1>

	<div>
		View as:
		<a href='/recipe/?format=json' target='_blank'>JSON</a> |
		<a href='/recipe/?format=pdf' target='_blank'>PDF</a>
	</div>


	@if($query)
		<h2>You searched for {{{ $query }}}</h2>
	@endif

	@if(sizeof($recipes) == 0)
		No results
	@else

		@foreach($recipes as $recipe)
			<section class='recipe'>

				<h2>{{ $recipe['title'] }}</h2>

				<p>
					<a href='/recipe/edit/{{$recipe['id']}}'>Edit</a>
				</p>

				<p>
					{{ $recipe['author']['name'] }} ({{$recipe['published']}})
				</p>

				<p>
					@foreach($recipe['tags'] as $tag)
						<span class='tag'>{{{ $tag->name }}}</span>
					@endforeach
				</p>

				<img src='{{ $recipe['cover'] }}'>
				<br>
				<a href='{{ $recipe['purchase_link'] }}'>Purchase...</a>
			</section>
		@endforeach

	@endif

@stop







