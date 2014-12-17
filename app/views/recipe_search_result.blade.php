<section>
	<img class='cover' src='{{ $recipe['cover'] }}'>

	<h2>{{ $recipe['title'] }}</h2>

	<p>
	{{ $recipe['author']->name }} {{ $recipe['published'] }}
	</p>

	<p>
		@foreach($recipe['tags'] as $tag)
			{{ $tag->name }}
		@endforeach
	</p>

	<a href='{{ $recipe['cover'] }}'>Purchase this recipe...</a>
	<br>
	<a href='/recipe/edit/{{ $recipe->id }}'>Edit</a>
</section>