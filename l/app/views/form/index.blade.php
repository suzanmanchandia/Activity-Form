@section('title')
Faculty Activity Form
@endsection

@section('before')
@include('form.nav')
@endsection

@section('content')

<div class="page-header">
<h1>USC Roski Faculty Activity Report</h1>
</div>

{{ Form::model($entry, array('route' => 'form.store', 'id' => 'form_entry', 'class' => 'form-ajax')) }}

<ul class="nav nav-tabs nav-scroll">
  <li class="active"><a href="#basic" data-toggle="tab">FACULTY INFORMATION</a></li>
  <li><a href="#student" data-toggle="tab">TEACHING AND STUDENT-CENTERED ACTIVITIES</a></li>
  <li><a href="#pro" data-toggle="tab">PROFESSIONAL WORK</a></li>
  <li><a href="#service" data-toggle="tab">SERVICE TO THE SCHOOL AND UNIVERSITY</a></li>
  <li><a href="#mentoring" data-toggle="tab">FORMAL PEER-TO-PEER MENTORING</a></li>
  <li><a href="#accomplishments" data-toggle="tab">ACCOMPLISHMENTS</a></li>
  <li><a href="#media" data-toggle="tab">MEDIA / FILES</a></li>
  <li><a href="#submit" data-toggle="tab">SUBMIT</a></li>
</ul>
<div class="tab-content form-pane">
  <div class="tab-pane fade active in" id="basic">

    <div class="form-group">
    	<label class="control-label" for="entry_first_name">Name</label>
    	<div class="row controls">
    		<div class="col-sm-4">
    			{{ Form::text('first_name', $staff->first_name, array('class' => 'form-control input-sm', 'required', 'autofocus', 'id' => 'entry_first_name')) }}
    			<label for="entry_first_name" class="input-top">First name</label>
    		</div>
    		<div class="col-sm-4">
    			{{ Form::text('last_name', $staff->last_name, array('class' => 'form-control input-sm', 'required', 'id' => 'entry_last_name')) }}
    			<label for="entry_last_name" class=" input-top">Last name</label>
    		</div>
    	</div>
    </div>

    <div class="form-group">
        <div class="row">
            <div class="col-sm-4">
                <label class="control-label" for="entry_title">Title & Rank</label>
            
                {{ Form::text('title', $entry->title, array('class' => 'form-control input-sm', 'required', 'id' => 'entry_title', 'placeholder' => 'Ex: Assistant Professor of Teaching')) }}
            </div>
        </div>
    </div>
    
    <div class="form-group">
        <div class="row">
            <div class="col-sm-4">
                <label class="control-label" for="entry_rank">Profile</label>
        
                <!--
                {{ Form::text('rank', null, array('class' => 'form-control input-sm', 'id' => 'entry_rank')) }}
                -->
                {{ Form::select('rank',array( 'Tenure'=>'Tenure','Teaching'=>'Teaching', 'Practice'=>'Practice'), null, array('class' => 'form-control', 'id' => 'entry_rank', 'required'))}}
            </div>
        </div>
    </div>

    <div class="form-group">
    	<label class="control-label" for="entry_period">Period Covered: January 1 - December 31</label>
    	<div class="row">
    		<div class="col-sm-2">
    		    <p class="form-control-static">2018</p> 
    		    <input type="hidden" id="entry_period" name="period" value="2018">
    		    <!--
    			{{ Form::select('period', array('2018' => '2018'), null, array('class' => 'form-control', 'id' => 'entry_period', 'type' => 'hidden', 'value'=>'2018', 'disabled')) }}
    			
    			{{ Form::select('period', Config::get('lists.period'), null, array('class' => 'form-control', 'id' => 'entry_period')) }}
    			-->
    		</div>
    	</div>
    </div>

  </div>
    <div class="tab-pane fade" id="student">
        <h4></h4>
    	@foreach(Config::get('lists.semesters') as $semester)
    	<fieldset>
        <label class="control-label" for="entry_independent_study">Courses Taught in {{ $semester }} Semester</label>
        @if ($semester != "Summer")
        <p><u>Instructions - Please list course name, section number and course units. Indicate course releases if applicable.</u></p>
        @endif
        @foreach(range(1,8) as $counter)
        @if ($entry[strtolower($semester) . '_course'.$counter] == NULL and $counter > 3)<?php $counter = $counter-1; ?> @break
        @endif
        <div class="form-group">
        <!--
        	<label class="control-label" for="entry_course{{ $counter.$semester }}">Course {{ $counter }} {{{ $counter > 1 ? '(if applicable)' : '' }}}</label>
            --> 
        	<div class="row">
        		<div class="col-sm-8">
        			{{ Form::text(strtolower($semester) . '_course'.$counter, null, array('class' => 'form-control input-sm', 'id' => 'entry_course'.$counter.$semester)) }}
        		</div>
        	</div>
        </div>
        @endforeach
    	</fieldset>
        @if ($counter < 8)
        <div class="{{strtolower($semester).'_courses_col'}}"> 
        </div>
        {{ Form::button('Add more', array('class' => 'btn btn-info btn-sm addmore','id'=>'addmore','counter'=> $counter, 'semester'=> strtolower($semester), 'div'=> strtolower($semester).'_courses_col', 'typef' => 'Course', 'total' => 8)) }}
        @endif
        <hr>
        @endforeach

        <div class="form-group">
            <label class="control-label" for="entry_independent_study">Independent Study / Formal Mentoring / Thesis Committee Participation</label>
            <p>Formally assigned mentoring unrelated to any course work.</p>
            <div class="row">
                <div class="col-sm-8">
                    {{ Form::textarea('independent_study', null, array('class' => 'form-control input-sm', 'id' => 'entry_independent_study')) }}
                </div>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label" for="entry_pg_sponsorship">Post Graduation Sponsorship</label>
            <p>Help with professional practises, internship/job/gradschool entry outcomes, grants etc.</p>
            <div class="row">
                <div class="col-sm-8">
                    {{ Form::textarea('pg_sponsorship', null, array('class' => 'form-control input-sm', 'id' => 'entry_pg_sponsorship')) }}
                </div>
            </div>
        </div>    

        <div class="form-group">
        	<label class="control-label" for="entry_guest_teaching_lecturing">Guest Teaching and Studio Visits at other institutions</label>
        	<div class="row">
        		<div class="col-sm-8">
        			{{ Form::textarea('guest_teaching_lecturing', null, array('class' => 'form-control input-sm', 'id' => 'entry_guest_teaching_lecturing')) }}
        		</div>
        	</div>
        </div>

        <div class="form-group">
        	<label class="control-label" for="entry_semester_reviews">End of Semester MFA/MA/MFA Design Reviews</label>
        	<div class="row">
        		<div class="col-sm-8">
        			{{ Form::text('semester_reviews', null, array('class' => 'form-control input-sm', 'id' => 'entry_semester_reviews')) }}
        		</div>
        	</div>
        </div>

        <div class="form-group">
            <label class="control-label" for="entry_admissions">Admissions, Recruitment, and Conversion Efforts</label>
            <div class="row">
                <div class="col-sm-8">
                    {{ Form::textarea('admissions', null, array('class' => 'form-control input-sm', 'id' => 'entry_admissions')) }}
                </div>
            </div>
        </div>    

        <hr>

        <div class="form-group">
            <label class="control-label" for="entry_student_events">Student Events Attended</label>
            <div class="row">
                <div class="col-sm-8 col-sm-offset-1" id="entry_student_events">
                <div class="row">
                    <div class="row form-check form-check-inline"> 
                        <div class="col-md-5"> 
                        <p>Commencement Ceremony</p>
                        </div>
                        <div class="col-md-3">
                            <center>
                            {{ Form::checkbox('student_events_commencement_ceremony', true, null, array('class' => 'form-check-input', 'id' => 'entry_student_events_commencement_ceremony')) }}
                            </center>
                        </div>
                    </div>
                     <div class="row form-check form-check-inline"> 
                        <div class="col-md-5"> 
                        <p>Student Show at Fisher Museum</p>
                        </div>
                        <div class="col-md-3"> 
                            <center>
                            {{ Form::checkbox('student_events_fisher_museum', true, null, array('class' => 'form-check-input', 'id' => 'entry_student_events_fisher_museum')) }}
                            </center>
                        </div>
                    </div>
                    <div class="row form-check form-check-inline"> 
                        <div class="col-md-5">
                            <p>Undergraduate Open Studios</p>
                        </div> 
                        <div class="col-md-3"> 
                            <center>
                            {{ Form::checkbox('student_events_undergradute_open_studios', true, null, array('class' => 'form-check-input', 'id' => 'entry_student_events_undergradute_open_studios')) }}
                            </center>
                        </div>
                    </div>
                    <div class="row form-check form-check-inline"> 
                        <div class="col-md-5">
                            <p>MFA Open Studios</p>
                        </div>
                        <div class="col-md-3">
                            <center> 
                            {{ Form::checkbox('student_events_mfa_open_studios', true, null, array('class' => 'form-check-input', 'id' => 'entry_student_events_mfa_open_studios')) }}
                            </center>
                        </div>
                    </div>
                    <div class="row form-inline"> 
                        <div class="col-md-5">
                            <p>Number of Lindhurst Gallery Exhibitions attended</p>
                        </div> 
                        <div class="col-md-3"> 
                            {{ Form::input('text','student_events_lindhurst_gallery_exhibitions',$entry->student_events_lindhurst_gallery_exhibitions,array('class' => 'form-control input-sm','id' => 'entry_student_events_lindhurst_gallery_exhibitions',''))}}
                        </div>
                    </div>
                    <div class="row form-inline"> 
                        <div class="col-md-5"> 
                            <p>Number of MFA Exhibitions attended</p>
                        </div>
                        <div class="col-md-3"> 
                            {{ Form::input('text','student_events_mfa_exhibitions',$entry->student_events_mfa_exhibitions,array('class' => 'form-control input-sm','id' => 'entry_student_events_mfa_exhibitions',''))}}
                        </div>
                    </div>
                    <div class="row form-inline"> 
                        <div class="col-md-5"> 
                            <p>Number of MA Exhibitions attended</p>
                        </div>
                        <div class="col-md-3" >
                            {{ Form::input('text','student_events_ma_exhibitions',$entry->student_events_ma_exhibitions,array('class' => 'form-control input-sm','id' => 'entry_student_events_ma_exhibitions'))}}
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>

        <div class="form-group">
        	<label class="control-label" for="entry_additional_student_events">Additional Student Events</label>
            <p>Example: open studios, participation in, organization of or attendance at student events such as open studios, student exhibitions, welcome events, student organizations etc.</p>
        	<div class="row">
        		<div class="col-sm-8">
        			{{ Form::textarea('additional_student_events', null, array('class' => 'form-control input-sm', 'id' => 'entry_additional_student_events')) }}
        		</div>
        	</div>
        </div>

    </div>
  <div class="tab-pane fade" id="pro">

    <div class="form-group">
    	<label class="control-label" for="entry_exhibitions">Exhibitions / Commissions / Writings and Publications / Curatorial Projects / Design Commissions including Commercial and/or Client based work</label>
    	<div class="row">
    		<div class="col-sm-8">
    			{{ Form::textarea('exhibitions', null, array('class' => 'form-control input-sm', 'id' => 'entry_exhibitions')) }}
    		</div>
    	</div>
    </div>

    <div class="form-group">
    	<label class="control-label" for="entry_reviews">Reviews, monographs, essays, articles, etc. written about your work. Complete bibliographic entries.</label>
    	<div class="row">
    		<div class="col-sm-8">
    			{{ Form::textarea('reviews', null, array('class' => 'form-control input-sm', 'id' => 'entry_reviews')) }}
    		</div>
    	</div>
    </div>

    <div class="form-group">
        	<label class="control-label" for="entry_grants_and_awards">Grants and Awards</label>
        	<div class="row">
        		<div class="col-sm-8">
        			{{ Form::textarea('grants_and_awards', null, array('class' => 'form-control input-sm', 'id' => 'entry_grants_and_awards')) }}
        		</div>
        	</div>
        </div>

    <hr>
    <label class="control-label">Lectures, panel discussions and workshops.</label>
    <p><u>Instructions - Please list as follows: Title and Type of lecture, Event Title (if applicable), Host institution, Date</u></p>
    <p>Public invited lectures, artist talks, panel discussions and other professional appearances (note: this should not include guest teaching or lecturing as identified in section II above)</p>
    @foreach(range(1,8) as $counter)
    @if ($entry['lecture'.$counter] == NULL and $counter > 3) <?php $counter = $counter-1; ?> @break
    @endif
    <div class="form-group">
    <!--
        <label class="control-label" for="entry_lectures">Lectures or Panel Discussion {{ $counter }} {{{ $counter > 1 ? '(if applicable)' : '' }}}</label>
        -->
        <div class="row">
            <div class="col-sm-8">
                {{ Form::text('lecture'.$counter, null, array('class' => 'form-control input-sm', 'id' => 'entry_lecture'.$counter)) }}
            </div>
        </div>
    </div>
    @endforeach
    @if($counter < 8)
    <div class="lectures_col"> 
    </div>
    {{ Form::button('Add more', array('class' => 'btn btn-info btn-sm addmorebasic','id'=>'addmore','counter'=> $counter, 'name'=> 'lecture', 'label'=> 'Lectures or Panel Discussion','div'=> 'lectures_col', 'typef' => 'Lecture', 'total' => 8)) }}
    @endif
    <hr>
    
      <div class="form-group">
    	  <label class="control-label" for="entry_juries_advisory">Your Participation on Juries and Advisory Boards</label>
          <p><u>Instructions - Please specify dates and roles.</u></p>
    	  <div class="row">
    		  <div class="col-sm-8">
    			  {{ Form::textarea('juries_advisory', null, array('class' => 'form-control input-sm', 'id' => 'entry_juries_advisory')) }}
    		  </div>
    	  </div>
      </div>
    <hr>
    <div class="form-group">
    	<label class="control-label" for="entry_research">Research and Work in Progress</label>
    	<div class="row">
    		<div class="col-sm-8">
    			{{ Form::textarea('research', null, array('class' => 'form-control input-sm', 'id' => 'entry_research')) }}
    		</div>
    	</div>
    </div>
  </div>

  <div class="tab-pane fade" id="mentoring">
    <div class="form-group">
        <label class="control-label" for="entry_mentoring">Provide details on your mentoring of other faculty members.</label>
        <div class="row">
            <div class="col-sm-8">
                {{ Form::textarea('mentoring', null, array('class' => 'form-control input-sm', 'id' => 'entry_mentoring')) }}
            </div>
        </div>
    </div>
  </div>

  <div class="tab-pane fade" id="service">
    <label class="control-label">University Committees</label>
    <p><u>Instructions - Please specify dates and roles. Also, how often did the committee meet and how many times did it meet</u></p>

    @foreach(range(1,10) as $counter)
    @if ($entry['university_committee'.$counter] == NULL and $counter > 3)<?php $counter = $counter-1; ?> @break
    @endif
    <div class="form-group">
    <!--
    	<label class="control-label" for="entry_university_committee{{ $counter }}">Committee # {{ $counter }}</label>
        -->
    	<div class="row">
    		<div class="col-sm-8">
    			{{ Form::text('university_committee'.$counter, null, array('class' => 'form-control input-sm', 'id' => 'entry_university_committee'.$counter)) }}
    		</div>
    	</div>
    </div>
    @endforeach
    @if($counter < 10)
    <div class="committees_col"> 
    </div>
    {{ Form::button('Add more', array('class' => 'btn btn-info btn-sm addmorebasic','id'=>'addmore','counter'=> $counter, 'name'=> 'university_committee', 'label'=> 'Committee #','div'=> 'committees_col', 'typef' => 'Committee', 'total' => 10)) }}
    @endif
    <hr>

    <label class="control-label">University Special Projects, Events, or Programs</label>
    <p><u>Instructions - Please specify dates and roles.</u></p>
    <p>This does not include faculty initiated projects such as Visions and Voices, or ASHSS Grants. Such grants may be listed under section 3: Professional work.</p>

    @foreach(range(1,10) as $counter)
    @if ($entry['project'.$counter] == NULL and $counter > 3) <?php $counter = $counter-1 ?> @break
    @endif
    <div class="form-group">
    <!--
    	<label class="control-label" for="entry_project{{ $counter }}">Project, Event, or Program # {{ $counter }}</label>
        -->
    	<div class="row">
    		<div class="col-sm-8">
    			{{ Form::text('project'.$counter, null, array('class' => 'form-control input-sm', 'id' => 'entry_project'.$counter)) }}
    		</div>
    	</div>
    </div>
    @endforeach
    @if ($counter < 10)
    <div class="projects_col"> 
    </div>
    {{ Form::button('Add more', array('class' => 'btn btn-info btn-sm addmorebasic','id'=>'addmore','counter'=> $counter, 'name'=> 'project', 'label'=> 'Project, Event, or Program #','div'=> 'projects_col', 'typef' => 'Project', 'total' => 10)) }}
    @endif

    <hr>
    <label class="control-label">University / School Initiatives, Events, or Programs</label>
    <p><u>Instruction - Please specify dates and roles.</u></p>

    @foreach(range(1,10) as $counter)
    @if ($entry['initiative'.$counter] == NULL and $counter > 3) <?php $counter = $counter-1 ?> @break
    @endif
    <div class="form-group">
    <!--
    	<label class="control-label" for="entry_initiative{{ $counter }}">Initiative,  # {{ $counter }}</label>
        -->
    	<div class="row">
    		<div class="col-sm-8">
    			{{ Form::text('initiative'.$counter, null, array('class' => 'form-control input-sm', 'id' => 'entry_initiative'.$counter)) }}
    		</div>
    	</div>
    </div>
    @endforeach
    @if($counter < 10)
    <div class="initiative_col"> 
    </div>
    {{ Form::button('Add more', array('class' => 'btn btn-info btn-sm addmorebasic','id'=>'addmore','counter'=> $counter, 'name'=> 'initiative', 'label'=> 'Initiative, Event, or Program #','div'=> 'initiative_col', 'typef' => 'Initiative', 'total' => 10)) }}
    @endif
    <hr>
    <label class="control-label">Roski Committee Service</label>
    <p><u>Instructions - Please specify dates and roles. Also, how often did the committee meet and how many times did it meet.</u></p>

    @foreach(range(1,10) as $counter)
    @if ($entry['roski_committee'.$counter] == NULL and $counter > 5) <?php $counter = $counter-1 ?> @break
    @endif
    <div class="form-group">
    <!--
    	<label class="control-label" for="entry_roski_committee{{ $counter }}">Committee # {{ $counter }}</label>
        -->
    	<div class="row">
    		<div class="col-sm-8">
    			{{ Form::text('roski_committee'.$counter, null, array('class' => 'form-control input-sm', 'id' => 'entry_roski_committee'.$counter)) }}
    		</div>
    	</div>
    </div>
    @endforeach
    @if($counter < 10)
    <div class="roski_committee_col"> 
    </div>
    {{ Form::button('Add more', array('class' => 'btn btn-info btn-sm addmorebasic','id'=>'addmore','counter'=> $counter, 'name'=> 'roski_committee', 'label'=> 'Committee #','div'=> 'roski_committee_col', 'typef' => 'Committee', 'total' => 10)) }}
    @endif
    <hr>
    <div class="form-group">
    	<label class="control-label" for="entry_development">Roski Special Service in Academic Development</label>
        <p><u>Instructions - Please specify dates and roles.</u></p>
        <p>Including any special projects as defined by the department or  school.</p>
    	<div class="row">
    		<div class="col-sm-8">
    			{{ Form::textarea('development', null, array('class' => 'form-control input-sm', 'id' => 'entry_development')) }}
    		</div>
    	</div>
    </div>

    <hr>
    <label class="control-label">Cross-Disciplinary work with other units within USC</label>
    <p><u>Instructions - Please specify dates and roles.</u></p>

    @foreach(range(1,5) as $counter)
    @if ($entry['work'.$counter] == NULL and $counter > 3) <?php $counter = $counter-1 ?> @break
    @endif
    <div class="form-group">
    <!--
    	<label class="control-label" for="entry_work{{ $counter }}">Cross-Disciplinary Work # {{ $counter }}</label>
        -->
    	<div class="row">
    		<div class="col-sm-8">
    			{{ Form::text('work'.$counter, null, array('class' => 'form-control input-sm', 'id' => 'entry_work'.$counter)) }}
    		</div>
    	</div>
    </div>
    @endforeach
    @if($counter < 5)
    <div class="work_col"> 
    </div>
    {{ Form::button('Add more', array('class' => 'btn btn-info btn-sm addmorebasic','id'=>'addmore','counter'=> $counter, 'name'=> 'work', 'label'=> 'Cross-Disciplinary Work #','div'=> 'work_col', 'typef' => 'Work', 'total' => 5)) }}
    @endif
  </div>

  <div class="tab-pane" id="accomplishments">

    <div class="form-group">
    	<label class="control-label" for="entry_accomplishments">Other accomplishments that you feel made a special contribution to the Roski School and/or University.</label>
    	<div class="row">
    		<div class="col-sm-8">
    			{{ Form::textarea('accomplishments', null, array('class' => 'form-control input-sm', 'id' => 'entry_development')) }}
    		</div>
    	</div>
    </div>

    <div class="form-group">
    	<label class="control-label" for="entry_comments">Comments on anything else you feel is worthy of consideration for this academic period that has not been indicated above.</label>
    	<div class="row">
    		<div class="col-sm-8">
    			{{ Form::textarea('comments', null, array('class' => 'form-control input-sm', 'id' => 'entry_comments')) }}
    		</div>
    	</div>
    </div>

  </div>

  <div class="tab-pane " id="media">

    @include('utils.upload', ['label' => 'Please upload a current copy of your resume. ', 'name' => 'resume', 'filters' => '.pdf,.doc,.docx,.rtf', 'existing' => $entry->existingFilesJson('resume')])

    <hr>

    <p><u>Instructions - Please upload copies of all syllabi you have developed and used for the academic year.</u></p>

    @foreach(range(1,10) as $counter)

    @include('utils.upload', ['label' => 'File ' . $counter, 'name' => 'syllabus'.$counter, 'filters' => '.pdf,.doc,.docx,.rtf', 'existing' => $entry->existingFilesJson('syllabus'.$counter, 'Syllabus ' . $counter)])

    @endforeach
  </div>

  <div class="tab-pane fade" id="submit">


    <div class="form-group">
    	<label class="control-label" for="entry_initials">By entering my initials and submitting this form, I attest that all the above information is correct.</label>
    	<div class="row">
    		<div class="col-sm-4">
    			{{ Form::text('initials', null, array('class' => 'form-control input-sm', 'id' => 'entry_initials', )) }}
    		</div>
    	</div>
    </div>

    <div class="form-group">
    	<label class="control-label" for="entry_date">Date Submitted.</label>
    	<div class="row">
    		<div class="col-sm-4">
    			{{ Form::text('date', date('m/d/Y'), array('class' => 'form-control', 'id' => 'entry_date', 'data-type' => 'date')) }}
    		</div>
    	</div>
    </div>
    <div class="col-sm-1">
    <p>
        <input class="btn btn-success" type="button" value="Submit" data-disable-with="Please wait...">
        <input name="confirm" id="confirmField" type="hidden" value="yes" disabled>
    </p>
    </div>
    <div class="col-sm-6">
        <h5><b>By clicking the submit button you will be redirected to a pdf preview of the form. Please download or print it for your records. </b></h5>
    </div>

  </div>

</div>

<div class="form-action">
<div class="container">

	<span class="btn btn-default disabled btn-prev">&lsaquo; Back</span>
	<span class="btn btn-default btn-next">Next &rsaquo;</span>
	{{--<a href="{{ route('form.review')  }}" class="btn btn-success">Review &amp; Submit Entry</a>--}}
	<input class="btn btn-primary" type="submit" value="Save Entry" data-disable-with="Please wait...">
</div>
</div>

{{ Form::close() }}

@endsection