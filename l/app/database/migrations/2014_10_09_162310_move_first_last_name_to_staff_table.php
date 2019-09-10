<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MoveFirstLastNameToStaffTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('staff', function(Blueprint $table) {
			$table->string('last_name', 100)->after('id');
			$table->string('first_name', 100)->after('id');
		});

		Staff::unguard();

		foreach (Entry::all() as $entry) {
			/* @var $entry Entry */
			if ($entry->first_name && $entry->last_name) {
				$entry->staff()->update(array_only($entry->getAttributes(), ['first_name', 'last_name']));
			}
		}

		Schema::table('entries', function(Blueprint $table) {
			$table->dropColumn('first_name');
			$table->dropColumn('last_name');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Entry::unguard();

		Schema::table('entries', function(Blueprint $table) {
			$table->string('last_name', 100)->after('id');
			$table->string('first_name', 100)->after('id');
		});

		foreach (Staff::all() as $staff) {
			/* @var $staff Staff */
			if ($staff->first_name && $staff->last_name) {
				$staff->entries()->update(array_only($staff->getAttributes(), ['first_name', 'last_name']));
			}
		}

		Schema::table('staff', function(Blueprint $table) {
			$table->dropColumn('first_name');
			$table->dropColumn('last_name');
		});
	}

}
