<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		// Creating the user table on migration up
		
		// first drop the user table if it exist.
		Schema::dropIfExists('users');

		// creating the schema
		Schema::create('users', function ($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('display_name', 60);
            $table->string('email', 100);
            $table->string('password', 100);
            $table->string('remember_token', 100);
            $table->timestamp('last_login');
            $table->tinyInteger('status')->default(0);
            $table->timestamps();

            $table->index('status');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		// Dropping the users table on migration down
		Schema::dropIfExists('users');
	}

}
