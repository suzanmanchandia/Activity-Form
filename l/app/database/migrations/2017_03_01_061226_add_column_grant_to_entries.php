<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnGrantToEntries extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('entries', function(Blueprint $table){
			$table->mediumText('grants_and_awards');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		
		Schema::table('entries', function(Blueprint $table){
			$table->dropColumn('grants_and_awards');
		});
	}

}
