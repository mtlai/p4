<!DOCTYPE html>
<html>
<head>

	<title>@yield('title','Foobooks')</title>
	<meta charset='utf-8'>

	<link href="//netdna.bootstrapcdn.com/bootswatch/3.1.1/flatly/bootstrap.min.css" rel="stylesheet">
	<link rel='stylesheet' href='/css/foobooks.css' type='text/css'>

	@yield('head')


</head>
<body>

	@if(Session::get('flash_message'))
		<div class='flash-message'>{{ Session::get('flash_message') }}</div>
	@endif

	<a href='/'><img class='logo' src='/images/laravel-foobooks-logo@2x.png' alt='Foobooks logo'></a>

	<nav>
		<ul>
		@if(Auth::check())
			<li><a href='/logout'>Log out {{ Auth::user()->email; }}</a></li>
			<li><a href='/book'>All Books</a></li>
			<li><a href='/book/search'>Search Books (w/ Ajax)</a></li>
			<li><a href='/tag'>All Tags</a></li>
			<li><a href='/book/create'>+ Add Book</a></li>
			<li><a href='/debug/routes'>Routes</a></li>
		@else
			<li><a href='/signup'>Sign up</a> or <a href='/login'>Log in</a></li>
		@endif
		</ul>
	</nav>

	<a href='https://github.com/susanBuck/foobooks'>View on Github</a>

	@yield('content')

	@yield('/body')

</body>
</html>





