<?php

class RecipeController extends \BaseController {


	/**
	*
	*/
	public function __construct() {

		# Make sure BaseController construct gets called
		parent::__construct();

		$this->beforeFilter('auth', array('except' => ['getIndex','getDigest']));

	}


	/**
	* Used as an example for something you might want to set up a cron job for
	*/
	public function getDigest() {

		$recipes = Recipe::getRecipesAddedInTheLast24Hours();

		$users = User::all();

		$recipients = Recipe::sendDigests($users,$recipes);

		$results = 'Recipe digest sent to: '.$recipients;

		Log::info($results);

		return $results;

	}


	/**
	* Process the searchform
	* @return View
	*/
	public function getSearch() {

		return View::make('recipe_search');

	}


	/**
	* Display all recipes
	* @return View
	*/
	public function getIndex() {

		# Format and Query are passed as Query Strings
		$format = Input::get('format', 'html');

		$query  = Input::get('query');

		$recipes = Recipe::search($query);

		# Decide on output method...
		# Default - HTML
		if($format == 'html') {
			return View::make('recipe_index')
				->with('recipes', $recipes)
				->with('query', $query);
		}
		# JSON
		elseif($format == 'json') {
			return Response::json($recipes);
		}
		# PDF (Coming soon)
		elseif($format == 'pdf') {
			return "This is the pdf (Coming soon).";
		}


	}


	/**
	* Show the "Add a recipe form"
	* @return View
	*/
	public function getCreate() {

		$authors = Author::getIdNamePair();

		$tags = Tag::getIdNamePair();

    	return View::make('recipe_add')
    		->with('authors',$authors)
    		->with('tags',$tags);

	}


	/**
	* Process the "Add a recipe form"
	* @return Redirect
	*/
	public function postCreate() {

		# Instantiate the recipe model
		$recipe = new Recipe();

//Move file to /public/uploads & store file name in database
//code based on: http://stackoverflow.com/questions/16635700/laravel-4-upload-image-form


/*WORKS*/
if (Input::hasFile('image_file_name')){
	$file = Input::file('image_file_name');
	$destinationPath = '/uploads/';
	$filename = $file->getClientOriginalName();
	Input::file('image_file_name')->move($destinationPath, $filename);
}else
	{$recipe->image_file_name  = Input::get('image_file_name', false);
}

/*If have time:   
Add string randomizer
check if file is empty

*/

/*if (Input::hasFile('image_file_name')){    //check if empty
	//$file = Input::file('image_file_name');
	$destinationPath = 'uploads/';
	$filename = $file->getClientOriginalName();
	Input::file('image_file_name')->move($destinationPath, $filename);
	//$image_file_name = $filename;
}else{
$recipe->image_file_name()  = Input::get('image_file_name', false);
}*/

/*
$image_file_name = "";
	if (Input::hasFile('file')){
		$filename = str_random(12) . ".jpg";
		$image_file_name = $filename;
		$file = Input::file('file')->move("/uploads", $filename);
		
	}

	
	
$file = Input::file('file');
$destinationPath = 'uploads';
// If the uploads fail due to file system, you can try doing public_path().'/uploads' 
$filename = str_random(12);
//$filename = $file->getClientOriginalName();
//$extension =$file->getClientOriginalExtension(); 
$upload_success = Input::file('file')->move($destinationPath, $filename);

if( $upload_success ) {
   return Response::json('success', 200);
} else {
   return Response::json('error', 400);
}	
	
	
	*/

	
		
		$recipe->fill(Input::except('tags', 'image_file_name'));
	
	
	
//	$recipe->image_file_name = $destinationPath . $filename;

if (Input::hasFile('image_file_name')){
	$recipe->image_file_name = $destinationPath . $filename;
}else {
	$recipe->image_file_name  = Input::get('image_file_name', false);
}



		# Note this save happens before we enter any tags (next step)
		$recipe->save();

		foreach(Input::get('tags') as $tag) {

			# This enters a new row in the recipe_tag table
			$recipe->tags()->save(Tag::find($tag));

		}

		return Redirect::action('RecipeController@getIndex')->with('flash_message','Your recipe has been added.');

	}


	/**
	* Show the "Edit a recipe form"
	* @return View
	*/
	public function getEdit($id) {

		try {

			# Get all the authors (used in the author drop down)
			$authors = Author::getIdNamePair();

			# Get this recipe and all of its associated tags
		    $recipe    = Recipe::with('tags')->findOrFail($id);

		    # Get all the tags (not just the ones associated with this recipe)
		    $tags    = Tag::getIdNamePair();
		}
		catch(exception $e) {
		    return Redirect::to('/recipe')->with('flash_message', 'Recipe not found');
		}

    	return View::make('recipe_edit')
    		->with('recipe', $recipe)
    		->with('authors', $authors)
    		->with('tags', $tags);

	}


	/**
	* Process the "Edit a recipe form"
	* @return Redirect
	*/
	public function postEdit() {

		try {
	        $recipe = Recipe::with('tags')->findOrFail(Input::get('id'));
	    }
	    catch(exception $e) {
	        return Redirect::to('/recipe')->with('flash_message', 'Recipe not found');
	    }

	    try {
		    # http://laravel.com/docs/4.2/eloquent#mass-assignment
		    $recipe->fill(Input::except('tags'));
		    $recipe->save();

		    # Update tags associated with this recipe
		    if(!isset($_POST['tags'])) $_POST['tags'] = array();
		    $recipe->updateTags($_POST['tags']);

		   	return Redirect::action('RecipeController@getIndex')->with('flash_message','Your changes have been saved.');

		}
		catch(exception $e) {
	        return Redirect::to('/recipe')->with('flash_message', 'Error saving changes.');
	    }

	}


	/**
	* Process recipe deletion
	*
	* @return Redirect
	*/
	public function postDelete() {

		try {
	        $recipe = Recipe::findOrFail(Input::get('id'));
	    }
	    catch(exception $e) {
	        return Redirect::to('/recipe/')->with('flash_message', 'Could not delete recipe - not found.');
	    }

	    Recipe::destroy(Input::get('id'));

	    return Redirect::to('/recipe/')->with('flash_message', 'Recipe deleted.');

	}


	/**
	* Process a recipe search
	* Called w/ Ajax
	*/
	public function postSearch() {

		if(Request::ajax()) {

			$query  = Input::get('query');

			# We're demoing two possible return formats: JSON or HTML
			$format = Input::get('format');

			# Do the actual query
	        $recipes  = Recipe::search($query);

	        # If the request is for JSON, just send the recipes back as JSON
	        if($format == 'json') {
		        return Response::json($recipes);
	        }
	        # Otherwise, loop through the results building the HTML View we'll return
	        elseif($format == 'html') {

		        $results = '';
				foreach($recipes as $recipe) {
					# Created a "stub" of a view called recipe_search_result.php; all it is is a stub of code to display a recipe
					# For each recipe, we'll add a new stub to the results
					$results .= View::make('recipe_search_result')->with('recipe', $recipe)->render();
				}

				# Return the HTML/View to JavaScript...
				return $results;
			}
		}
	}



}