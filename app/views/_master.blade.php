<!DOCTYPE html>
<html>
<head>

	<title>@yield('title','Secret Family Recipes')</title>
	<meta charset='utf-8'>

	<link href="//netdna.bootstrapcdn.com/bootswatch/3.1.1/flatly/bootstrap.min.css" rel="stylesheet">
	<link rel='stylesheet' href='/css/foorecipes.css' type='text/css'>

	@yield('head')


</head>
<body>

	@if(Session::get('flash_message'))
		<div class='flash-message'>{{ Session::get('flash_message') }}</div>
	@endif
<center>

	<a href='/'><img class='logo' src='/images/secret_family_recipes.png' alt='Foorecipes logo'></a>
</center>
	<nav>
		<ul>
		@if(Auth::check())
			<li><a href='/logout'>Log out {{ Auth::user()->email; }}</a></li>
			<li><a href='/recipe'>All Recipes</a></li>
			<li><a href='/recipe/search'>Search Recipes (w/ Ajax)</a></li>
			<li><a href='/tag'>All Tags</a></li>
			<li><a href='/recipe/create'>+ Add Recipe</a></li>
			<li><a href='/debug/routes'>Routes</a></li>
		@else
			<li><a href='/signup'>Sign up</a> ! <a href='/login'>Log in</a></li>
		@endif
		</ul>
	</nav>

	@yield('content')

	@yield('/body')


</body>
</html>





