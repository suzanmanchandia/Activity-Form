<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeStaffPinColumn extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		DB::statement('ALTER TABLE `staff` ALTER `pin` DROP DEFAULT;');
		DB::statement("ALTER TABLE `staff` CHANGE COLUMN `pin` `pin` VARCHAR(100) NOT NULL COLLATE 'utf8_unicode_ci' AFTER `email`;");
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		DB::statement('ALTER TABLE `staff` ALTER `pin` DROP DEFAULT;');
		DB::statement("ALTER TABLE `staff` CHANGE COLUMN `pin` `pin` CHAR(4) NOT NULL COLLATE 'utf8_unicode_ci' AFTER `email`;");
	}

}
