<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		if (!User::where('email', '=', 'roskiit@roski.usc.edu')->count()) {

			User::unguard();

			User::create([
				'email' => 'roskiit@roski.usc.edu',
				'password' => Hash::make('changeme'),
				'first_name' => 'roski',
				'last_name'  => 'it',
				'user_rank' => 'Tenure'
			]);
		}
	}

}
