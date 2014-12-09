<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return View::make('hello');
});

Route::get('/books', function() {
    return 'Here are all the books...';
}); 

Route::get('/books/{category}', function($category) {
        return 'Here are all the books in the category of '.$category;
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




Route::get('/get-environment',function() {

    echo "Environment: ".App::environment();

});

Route::get('/trigger-error',function() {

    # Class Foobar should not exist, so this should create an error
    $foo = new Foobar;

});