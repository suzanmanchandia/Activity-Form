<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNewColumnsEntries extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		if(!Schema::hasColumn('entries','semester_reviews')){
			Schema::table('entries', function(Blueprint $table){
				$table->mediumText('semester_reviews');
			});
		}
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		
		Schema::table('entries', function(Blueprint $table){
			$table->dropColumn('semester_reviews');
		});
	}

}
