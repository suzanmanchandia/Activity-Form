<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEntriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('entries', function(Blueprint $table){
			$table->engine = 'InnoDB';
			$table->increments('id');
			$table->unsignedInteger('staff_id');
			$table->foreign('staff_id')	
				->references('id')->on('staff')
				->onDelete('cascade');
			$table->text('first_name', 100);
			$table->text('last_name', 100);
			$table->text('rank');
			$table->text('title');
			$table->text('period');
			// Courses
			$table->text('fall_course1');
			$table->text('fall_course2');
			$table->text('fall_course3');
			$table->text('fall_course4');
			$table->text('fall_course5');
			$table->text('fall_course6');
			$table->text('fall_course7');
			$table->text('fall_course8');
			$table->text('spring_course1');
			$table->text('spring_course2');
			$table->text('spring_course3');
			$table->text('spring_course4');
			$table->text('spring_course5');
			$table->text('spring_course6');
			$table->text('spring_course7');
			$table->text('spring_course8');
			$table->text('summer_course1');
			$table->text('summer_course2');
			$table->text('summer_course3');
			$table->text('summer_course4');
			$table->text('summer_course5');
			$table->text('summer_course6');
			$table->text('summer_course7');
			$table->text('summer_course8');
			// Misc
			$table->mediumText('independent_study');
			$table->mediumText('pg_sponsorship');
			$table->mediumText('guest_teaching_lecturing');
			$table->mediumText('admissions');
			$table->mediumText('student_events');
			// Pro
			$table->mediumText('exhibitions');
			$table->mediumText('reviews');
			$table->text('lecture1',350);
			$table->text('lecture2',350);
			$table->text('lecture3',350);
			$table->text('lecture4',350);
			$table->text('lecture5',350);
			$table->text('lecture6',350);
			$table->text('lecture7',350);
			$table->text('lecture8',350);
			$table->mediumText('juries_advisory');
			$table->mediumText('research');
			// Service
			$table->mediumText('mentoring');
			$table->text('university_committee1',350);
			$table->text('university_committee2',350);
			$table->text('university_committee3',350);
			$table->text('university_committee4',350);
			$table->text('university_committee5',350);
			$table->text('university_committee6',350);
			$table->text('university_committee7',350);
			$table->text('university_committee8',350);
			$table->text('university_committee9',350);
			$table->text('university_committee10',350);	
			$table->text('project1',350);
			$table->text('project2',350);
			$table->text('project3',350);
			$table->text('project4',350);
			$table->text('project5',350);
			$table->text('project6',350);
			$table->text('project7',350);
			$table->text('project8',350);
			$table->text('project9',350);
			$table->text('project10',350);
			$table->text('initiative1',350);
			$table->text('initiative2',350);
			$table->text('initiative3',350);
			$table->text('initiative4',350);
			$table->text('initiative5',350);
			$table->text('initiative6',350);
			$table->text('initiative7',350);
			$table->text('initiative8',350);
			$table->text('initiative9',350);
			$table->text('initiative10',350);
			$table->text('roski_committee1');
			$table->text('roski_committee2');
			$table->text('roski_committee3');
			$table->text('roski_committee4');
			$table->text('roski_committee5');
			$table->text('roski_committee6');
			$table->text('roski_committee7');
			$table->text('roski_committee8');
			$table->text('roski_committee9');
			$table->text('roski_committee10');
			$table->mediumText('development');
			$table->text('work1',300);
			$table->text('work2',300);
			$table->text('work3',300);
			$table->text('work4',300);
			$table->text('work5',300);
			$table->mediumText('accomplishments');
			$table->mediumText('comments');
			$table->text('initials',5);
			$table->date('date');
			$table->boolean('submitted');
			// Others
			$table->softDeletes();
			$table->timestamps();
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
		Schema::dropIfExists('entries');
	}

}
