<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddReviewsColumnToEntry extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('entries', function(Blueprint $table) {
			$table->string('semester_reviews')->after('independent_study');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('entries', function(Blueprint $table) {
			$table->dropColumn('semester_reviews');
		});
	}

}
