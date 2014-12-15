<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSurveysTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */


	public function up() {

    Schema::create('survey_questions', function($table) {
		# command: php artisan migrate
        
        # Increments method will make a Primary, Auto-Incrementing field.
        # Most tables start off this way
        $table->increments('question_id');

        # The rest of the fields...
        $table->string('question_text');
        #enhancement: $table->string('question_type');      
        #enhancement: $table->integer('question_order');
       
      
    });
    
  
        Schema::create('survey_answers', function($table) {
		# php artisan migrate
        # Increments method will make a Primary, Auto-Incrementing field.
        # Most tables start off this way
        $table->increments('answer_id');

        # This generates two columns: `created_at` and `updated_at` to
        # keep track of changes to a row
        $table->timestamps();

        # The rest of the fields...
        $table->integer('question_id');
        $table->integer('user_id');
        $table->string('answer_text');

        # FYI: We're skipping the 'tags' field for now; more on that later.

    });
    
  
        Schema::create('users', function($table) {
		# php artisan migrate
        # Increments method will make a Primary, Auto-Incrementing field.
        # Most tables start off this way
        $table->increments('user_id');
     
        # The rest of the fields...
        $table->string('name_last');
        $table->string('name_first');
        $table->integer('role');
        #enhancement:$table->integer('school_code'); 
        #enhancement:$table->string('ethnicity');
        #enhancement:$table->string('state');
        #enhancement:$table->string('nation');


        # FYI: We're skipping the 'tags' field for now; more on that later.

    });
  
  
	}




	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
	}

}




