<?php


/**
* Index
*/
Route::get('/', 'IndexController@getIndex');
/**
* User
* (Explicit Routing)
*/
Route::get('/signup','UserController@getSignup' );
Route::get('/login', 'UserController@getLogin' );
Route::post('/signup', 'UserController@postSignup' );
Route::post('/login', 'UserController@postLogin' );
Route::get('/logout', 'UserController@getLogout' );
/**
* Recipe
* (Explicit Routing)
*/
Route::get('/recipe', 'RecipeController@getIndex');
Route::get('/recipe/edit/{id}', 'RecipeController@getEdit');
Route::post('recipe/edit', 'RecipeController@postEdit');
Route::get('/recipe/create', 'RecipeController@getCreate');
Route::post('/recipe/create', 'RecipeController@postCreate');
Route::post('/recipe/delete', 'RecipeController@postDelete');
Route::get('/recipe/digest', 'RecipeController@getDigest');

/* Ajax Search*/
Route::get('/recipe/search', 'RecipeController@getSearch');
Route::post('/recipe/search', 'RecipeController@postSearch');


/*PRACTICE*/
Route::get('/', function()
{
	return View::make('hello');
});

Route::get('/recipe', function() {
    return 'Here are all the recipes...';
}); 

Route::get('/recipes/{category}', function($category) {
        return 'Here are all the recipes in the category of '.$category;
}); 

Route::get('/new', function() {

    $view  = '<form method="POST">';
    $view .= 'Title: <input type="text" name="title">';
    $view .= '<input type="submit">';
    $view .= '</form>';
    return $view;

});

Route::post('/new', function() {

    $input =  Input::all();
    print_r($input);

});





/*TESTING*/

Route::get('/get-environment',function() {

    echo "Environment: ".App::environment();

});

Route::get('/trigger-error',function() {

    # Class Foobar should not exist, so this should create an error
    $foo = new Foobar;

});

Route::get('mysql-test', function() {

    # Print environment
    echo 'Environment: '.App::environment().'<br>';

    # Use the DB component to select all the databases
    $results = DB::select('SHOW DATABASES;');

    # If the "Pre" package is not installed, you should output using print_r instead
    echo Pre::render($results);

});