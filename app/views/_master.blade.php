<!DOCTYPE html>
<html>
<head>

	<title>@yield('title','Secret Family Recipes')</title>
	<meta charset='utf-8'>

	<!--Extra Style-->
    <link rel='stylesheet' href='{{ asset('styles/recipes.css') }}'>

	<link href="//netdna.bootstrapcdn.com/bootswatch/3.1.1/flatly/bootstrap.min.css" rel="stylesheet">
	@yield('head')


</head>
<body style="margin-left: 100px; margin-right: 100px;">

	@if(Session::get('flash_message'))
		<div class='flash-message'>{{ Session::get('flash_message') }}</div>
	@endif

	<a href='/'><img class='logo' src='/images/secret_family_recipes.png' alt='Foorecipes logo'></a>
	
	
	

	<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		<div class="container">
			<div class="navbar-header">
			
			<center>

				<a href='/'><img class='logo' src='/images/secret_family_recipes.png' alt='Recipes logo'></a>
			</center>
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
			</div><!--navbar-header-->
			<div class="navbar-collapse collapse">
				<ul class="nav navbar-nav">
				
				@if(Auth::check())
				
				<li id="navhome"><a href="/"><span class="glyphicon glyphicon-home"></span> Home</a></li>
				<li><a href='/recipe/create'><span class="glyphicon glyphicon-pencil"></span> Add Recipe</a></li>
					
				<li><a href='/recipe'><span class="glyphicon glyphicon-th-large"></span> View All Recipes</a></li>
				<li><a href='/tag'><span class="glyphicon glyphicon-tag"></span> Recipe Tags</a></li>
				
				
				<li><a href='/logout'><span class="glyphicon glyphicon-cog"></span> Logout {{ Auth::user()->email; }}</a></li>
				
				@else
					<li><a href='/signup'><span class="glyphicon glyphicon-user"></span> Sign up</a></li> 
					
					<li><a href='/login'>Log in</a></li>
				@endif
		
			</ul>
			</div><!--nav-collapse -->
		</div><!--container-->
	</div><!--navbar-->	
	


	@yield('content')

	@yield('/body')


</body>
</html>







