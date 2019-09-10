<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table){
			$table->engine = 'InnoDB';
			$table->increments('id');
			$table->string('first_name');
			$table->string('last_name');
			$table->string('email')->unique();
			$table->string('password');
			$table->string('user_rank',10);
			/*
				TT -> can see everything
				NTT -> can see NTT and Adjunct
				Adjunct -> can see Adjunct
			*/
			$table->rememberToken();
			$table->timestamps();
			$table->softDeletes();
			$table->engine = 'innodb';
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('users');
	}

}
