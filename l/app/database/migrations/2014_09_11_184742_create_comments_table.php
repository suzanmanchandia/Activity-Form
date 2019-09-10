<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('comments', function(Blueprint $table){
			$table->engine = 'InnoDB';
			$table->increments('id');
			$table->unsignedInteger('user_id');
			$table->unsignedInteger('entry_id');
			$table->foreign('user_id')
				->references('id')->on('users')
				->onDelete('cascade');
			$table->foreign('entry_id')
				->references('id')->on('entries')
				->onDelete('cascade');
			$table->mediumText('content');
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
		Schema::dropIfExists('comments');
	}

}
