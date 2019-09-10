<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ConsolidateEntryItems extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		/*
		Schema::table('entries', function(Blueprint $table){
			$table->mediumText('juries_advisory')->after('jury3');
		});

		DB::table('entries')->update(array(
			'juries_advisory' => DB::raw("TRIM(CONCAT_WS('\n\n', jury1, jury2, jury3))"),
		));
		*/
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('entries', function(Blueprint $table){
			$table->dropColumn('juries_advisory');
		});
	}

}
