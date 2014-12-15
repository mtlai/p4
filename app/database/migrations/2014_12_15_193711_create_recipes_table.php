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

		Schema::create('recipes', function($table) {
			$table->increments('id');
			$table->string('title');
			$table->text('ingredients');
			$table->text('instructions');
			$table->boolean('owner')->default(false);
			$table->string('image_url');
			$table->string('credit_url'); 
			$table->integer('user_id')->unsigned();
			$table->timestamps();
			
			#Foreign key to users table
			$table->foreign('user_id')->references('id')->on('users');
		});

		Schema::create('tags', function($table) {
			
			# AI, PK
			$table->increments('id');
			
			# created_at, updated_at columns
			$table->timestamps();
			
			# General data....
			$table->string('name')->unique();			

		});

		
		Schema::create('recipe_tag', function($table) {

			# General data.
			$table->integer('recipe_id')->unsigned();
			$table->integer('tag_id')->unsigned();
			
			# Define foreign keys...
			$table->foreign('recipe_id')->references('id')->on('recipes');
			$table->foreign('tag_id')->references('id')->on('tags');
			
		});
		



		
		
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		DB::statement('SET FOREIGN_KEY_CHECKS=0');
		Schema::drop('users');		
		Schema::drop('recipes');
		Schema::drop('recipes_tag');
		Schema::drop('tags');
		DB::statement('SET FOREIGN_KEY_CHECKS=1');
	}

}


