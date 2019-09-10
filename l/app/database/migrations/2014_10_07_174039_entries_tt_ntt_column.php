<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EntriesTtNttColumn extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('entries', function(Blueprint $table) {
			$table->string('tt_ntt', 12)->after('period');
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
			$table->dropColumn('tt_ntt');
		});
	}

}
