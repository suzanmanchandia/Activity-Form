<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRowsEntries extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('entries', function(Blueprint $table){
			$table->boolean('student_events_commencement_ceremony');
			$table->boolean('student_events_fisher_museum');
			$table->boolean('student_events_undergradute_open_studios');
			$table->boolean('student_events_mfa_open_studios');
			$table->integer('student_events_lindhurst_gallery_exhibitions');
			$table->integer('student_events_mfa_exhibitions');
			$table->integer('student_events_ma_exhibitions');
			$table->renameColumn('student_events','additional_student_events');
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
			$table->dropColumn('student_events_commencement_ceremony');
			$table->dropColumn('student_events_fisher_museum');
			$table->dropColumn('student_events_undergradute_open_studios');
			$table->dropColumn('student_events_mfa_open_studios');
			$table->dropColumn('student_events_lindhurst_gallery_exhibitions');
			$table->dropColumn('student_events_mfa_exhibitions');
			$table->dropColumn('student_events_ma_exhibitions');
			$table->renameColumn('additional_student_events','student_events');
		});
	}

}
