<?php

class RecipesSeeder extends Seeder {

	public function run() {

		# Clear the tables to a blank slate
		DB::statement('SET FOREIGN_KEY_CHECKS=0'); # Disable FK constraints so that all rows can be deleted, even if there's an associated FK
		DB::statement('TRUNCATE recipes');
		DB::statement('TRUNCATE authors');
		DB::statement('TRUNCATE tags');
		DB::statement('TRUNCATE recipe_tag');
		DB::statement('TRUNCATE users');

		# Authors
		$mom = new Author;
		$mom->name = 'Mom';
		$mom->birth_date = '1896-01-24';
		$mom->save();

		$grandmother = new Author;
		$grandmother->name = 'Grandmother';
		$grandmother->birth_date = '1952-12-27';
		$grandmother->save();

		$sister = new Author;
		$sister->name = 'Sister';
		$sister->birth_date = '1985-08-04';
		$sister->save();

		# Tags (Created using the Model Create shortcut method)
		# Note: Tags model must have `protected $fillable = array('name');` in order for this to work
		$Chinese         = Tag::create(array('name' => 'Chinese'));
		$Italian       = Tag::create(array('name' => 'Italian'));
		$Comfort    = Tag::create(array('name' => 'Comfort'));
		$Drinks       = Tag::create(array('name' => 'Drinks'));
		$Desserts        = Tag::create(array('name' => 'Desserts'));
		$Appetizers         = Tag::create(array('name' => 'Appetizers'));
		$Soups = Tag::create(array('name' => 'Soups'));

		# Recipes
		$greenbeans = new Recipe;
		$greenbeans->title = 'Garlic Green Beans';
		$greenbeans->published = 1925;
		$greenbeans->cover = 'http://graphics8.nytimes.com/images/2010/05/28/health/28recipehealth_600/28recipehealth_600-articleLarge.jpg';
		$greenbeans->credit_url = 'http://allrecipes.com/Recipe/Garlic-Green-Beans/';

		# Associate has to be called *before* the recipe is created (save())
		$greenbeans->author()->associate($mom); # Equivalent of $greenbeans->author_id = $mom->id
		$greenbeans->save();

		# Attach has to be called *after* the recipe is created (save()),
		# since resulting `recipe_id` is needed in the recipe_tag pivot table
		$greenbeans->tags()->attach($Chinese);
		

		$meatballs = new Recipe;
		$meatballs->title = 'Spaghetti and Meatballs';
		$meatballs->published = 1963;
		$meatballs->cover = 'http://www.simplyrecipes.com/wp-content/uploads/2008/04/spaghetti-meatballs.jpg';
		$meatballs->credit_url = 'http://www.simplyrecipes.com/recipes/spaghetti_and_meatballs/';
		$meatballs->author()->associate($grandmother);
		$meatballs->save();

		$meatballs->tags()->attach($Italian);

		$choccookies = new Recipe;
		$choccookies->title = 'Chocolate Chip';
		$choccookies->published = 1969;
		$choccookies->cover = 'http://2.bp.blogspot.com/-YkNQfL4WEW8/TxARub05BLI/AAAAAAAAASw/DRxSTZNax9o/s200/Chocolate_Chip_Cookies300.jpg';
		$choccookies->credit_url = 'http://www.cooksillustrated.com/recipes/4737-perfect-chocolate-chip-cookies';
		$choccookies->author()->associate($sister);
		$choccookies->save();
		$choccookies->tags()->attach($Comfort);

		$user = new User;
		$user->email      = 'tester@gmail.com';
		$user->password   = Hash::make('123456');
		$user->first_name = 'Jane';
		$user->last_name  = 'Doe';
		$user->save();


	}

}