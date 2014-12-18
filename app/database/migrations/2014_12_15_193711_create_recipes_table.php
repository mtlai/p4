<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecipesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{

		Schema::create('users', function($table) {

		    $table->increments('id');
		    $table->string('email')->unique();
		    $table->string('remember_token',100);
		    $table->string('password');
		    $table->string('first_name');
		    $table->string('last_name');
		    $table->timestamps();

		});


		Schema::create('authors', function($table) {

			# AI, PK
			$table->increments('id');
 
			# created_at, updated_at columns
			$table->timestamps();
 
			# General data...
			$table->string('name');
			$table->date('birth_date');
			
			# Define foreign keys...
			# none needed

		});


		Schema::create('books', function($table) {

			# AI, PK
			$table->increments('id');
			
			# created_at, updated_at columns
			$table->timestamps();
			
			# General data...
			$table->string('title');
			$table->integer('author_id')->unsigned(); # Important! FK has to be unsigned because the PK it will reference is auto-incrementing
			$table->integer('published');
			$table->string('cover');
			$table->string('purchase_link');
			
			# Define foreign keys...
			$table->foreign('author_id')->references('id')->on('authors');

		});
		
		
		Schema::create('recipes', function($table) {

			# AI, PK
			$table->increments('id');
			
			# created_at, updated_at columns
			$table->timestamps();
			
			# General data...
			$table->string('title');
			$table->integer('author_id')->unsigned(); # Important! FK has to be unsigned because the PK it will reference is auto-incrementing
			$table->integer('published');
			$table->text('ingredients');
			$table->text('instructions');
			$table->string('image_file_name');
			$table->string('cover');
			$table->string('credit_url');
			
			# Define foreign keys...
			$table->foreign('author_id')->references('id')->on('authors');

		});
		



		Schema::create('tags', function($table) {
			
			# AI, PK
			$table->increments('id');
			
			# created_at, updated_at columns
			$table->timestamps();
			
			# General data....
			$table->string('name')->unique();			

		});

		Schema::create('book_tag', function($table) {

			# AI, PK
			# none needed

			# General data...
			$table->integer('book_id')->unsigned();
			$table->integer('tag_id')->unsigned();
			
			# Define foreign keys...
			$table->foreign('book_id')->references('id')->on('books');
			$table->foreign('tag_id')->references('id')->on('tags');
			
		});

		
		Schema::create('recipe_tag', function($table) {

			# General data.
			$table->integer('recipe_id')->unsigned();
			$table->integer('tag_id')->unsigned();
			
			# Define foreign keys...
			/*$table->foreign('recipe_id')->references('id')->on('recipes');*/
			$table->foreign('recipe_id')->references('id')->on('recipes')->onDelete('cascade');
			
			/*$table->foreign('tag_id')->references('id')->on('tags');*/
			$table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade');
			/*$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');*/
			
		});
		



		
		
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		/*DB::statement('SET FOREIGN_KEY_CHECKS=0');
		Schema::drop('users');		
		Schema::drop('recipes');
		Schema::drop('recipes_tag');
		Schema::drop('tags');
		DB::statement('SET FOREIGN_KEY_CHECKS=1');*/
	}

}


