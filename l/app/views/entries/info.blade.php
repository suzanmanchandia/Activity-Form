<div class="tab-pane fade in active" id="entry{{ $entry->id }}_info">
	<dl>
		<dt>Name</dt>
		<dd><p>{{ $entry->staff->first_name }} {{ $entry->staff->last_name }}</p></dd>
		<dt>Rank</dt>
    	<dd><p>{{ $entry->rank }}</p></dd>
    	<dt>Title</dt>
    	<dd><p>{{ $entry->title }}</p></dd>
    	<dt>Period Covered: January 1 - December 31</dt>
    	<dd><p>{{ $entry->period }}</p></dd>
	</dl>
</div>
<div class="tab-pane fade" id="entry{{ $entry->id }}_student">
	@foreach(Config::get('lists.semesters') as $semester)
    <fieldset>
    	<dl>
    		<dt>Courses Taught in {{ $semester }} Semester</dt>
    		@foreach(range(1,8) as $counter)
    		@if ($entry->{strtolower($semester) . '_course'.$counter} !== '')
    		<dd><p>{{ $counter }}. {{{ $entry->{strtolower($semester) . '_course'.$counter}  }}}</p></dd>
    		@endif
    		@endforeach
    	</dl>
    </fieldset>
    <hr>
    @endforeach
    <dl>
        <dt>Independent Study / Formal Mentoring / Thesis Committee Participation</dt>
        <dd><p>{{ nl2br($entry->independent_study)  }}</p></dd>
        <dt>Post Graduation Sponsorship</dt>
        <dd><p>{{ nl2br($entry->pg_sponsorship)  }}</p></dd>
        <dt>Guest Teaching and Lecturing</dt>
        <dd><p>{{ nl2br($entry->guest_teaching_lecturing)  }}</p></dd>
        <dt>End of Semester MFA/MA Reviews</dt>
        <dd><p>{{ $entry->semester_reviews }}</p></dd>
        <dt>Admissions, Recruitment, and Conversion Efforts</dt>
        <dd><p>{{ nl2br($entry->admissions)  }}</p></dd>
        <dt>Student Events Attended</dt>
        <dd>
            <div class="row">
                <div class="col-md-9">
                    <div class="col-md-5 col-md-offset-1">
                    <p>
                        Commencement Ceremony
                    </p>
                    </div>
                    <div class="col-md-2">
                        <center>
                            @if ($entry->student_events_commencement_ceremony)
                            YES
                            @else
                            NO
                            @endif
                        </center>
                    </div>
                </div>
            </div>
        </dd>
        <dd>
            <div class="row">
                <div class="col-md-9">
                    <div class="col-md-5 col-md-offset-1">
                    <p>
                        Student Shows at Fisher Museum
                    </p>
                    </div>
                    <div class="col-md-2">
                        <center>
                            @if ($entry->student_events_fisher_museum)
                            YES
                            @else
                            NO
                            @endif
                        </center>
                    </div>
                </div>
            </div>
        </dd>
        <dd>
            <div class="row">
                <div class="col-md-9">
                    <div class="col-md-5 col-md-offset-1">
                    <p>
                        Undergraduate Open Studios
                    </p>
                    </div>
                    <div class="col-md-2">
                        <center>
                            @if ($entry->student_events_undergradute_open_studios)
                            YES
                            @else
                            NO
                            @endif
                        </center>
                    </div>
                </div>
            </div>
        </dd>
        <dd>
            <div class="row">
                <div class="col-md-9">
                    <div class="col-md-5 col-md-offset-1">
                    <p>
                         MFA Open Studios
                    </p>
                    </div>
                    <div class="col-md-2">
                        <center>
                            @if ($entry->student_events_mfa_open_studios)
                            YES
                            @else
                            NO
                            @endif
                        </center>
                    </div>
                </div>
            </div>
        </dd> 
        <dd>
            <div class="row">
                <div class="col-md-9">
                    <div class="col-md-5 col-md-offset-1">
                    <p>
                       Number of Lindhurst Gallery exhibitions attended:
                    </p>
                    </div>
                    <div class="col-md-2">
                        <center>
                            {{nl2br($entry->student_events_lindhurst_gallery_exhibitions)}}
                        </center>
                    </div>
                </div>
            </div>
        </dd>  
         <dd>
            <div class="row">
                <div class="col-md-9">
                    <div class="col-md-5 col-md-offset-1">
                    <p>
                       Number of MFA exhibitions attended:
                    </p>
                    </div>
                    <div class="col-md-2">
                        <center>
                            {{nl2br($entry->student_events_mfa_exhibitions)}}
                        </center>
                    </div>
                </div>
            </div>
        </dd>   
        <dd>
            <div class="row">
                <div class="col-md-9">
                    <div class="col-md-5 col-md-offset-1">
                    <p>
                       Number of MA exhibitions attended:
                    </p>
                    </div>
                    <div class="col-md-2">
                        <center>
                            {{nl2br($entry->student_events_ma_exhibitions)}}
                        </center>
                    </div>
                </div>
            </div>
        </dd> 
        <dt>Additional Student Events</dt>
        <dd><p>{{ nl2br($entry->additional_student_events)  }}</p></dd>
    </dl>
</div>

<div class="tab-pane fade" id="entry{{ $entry->id }}_pro">
	<dl>
		<dt>Exhibitions / Commissions / Writings and Publications / Curatorial Projects / Design Commissions including Commercial and/or Client based work
		</dt>
		<dd><p>{{ nl2br($entry->exhibitions)  }}</p></dd>
	    <dt>Reviews, monographs, essays, articles, etc. written about your work. Complete bibliographic entries.
		</dt>
		<dd><p>{{ nl2br($entry->reviews)  }}</p></dd>
		<dt>Grants and Awards</dt>
		<dd><p>{{ nl2br($entry->grants_and_awards)  }}</p></dd>
	</dl>

	<hr>
	<dl>
        <dt>Your scholarly lectures and panel discussions</dt>
        @foreach(range(1,8) as $counter)
        @if ($entry->{'lecture'.$counter} !== '')
        <dd><p>{{ $counter }}. {{{ $entry->{'lecture'.$counter}  }}}</p></dd>
        @endif
        @endforeach
    </dl>
    
    <hr>
    <dl>
        <dt>Juries and Advisory Boards</dt>
        <dd><p>{{ nl2br($entry->juries_advisory)  }}</p></dd>
    </dl>

    <hr>
    <dl>
        <dt>Research and Work in Progress</dt>
        <dd><p>{{ nl2br($entry->research)  }}</p></dd>
    </dl>
</div>

<div class="tab-pane fade" id="entry{{ $entry->id }}_service">
    <dl>
        <dt>University Committees</dt>
        @foreach(range(1,10) as $counter)
        @if ($entry->{'university_committee'.$counter} !== '')
        <dd><p>{{ $counter }}. {{ $entry->{'university_committee'.$counter}  }}</p></dd>
        @endif
        @endforeach
    </dl>

    <hr>
    <dl>
        <dt>University Special Projects, Events, or Programs.</dt>
        @foreach(range(1,10) as $counter)
        @if ($entry->{'project'.$counter} !== '')
        <dd><p>{{ $counter }}. {{ $entry->{'project'.$counter}  }}</p></dd>
        @endif
        @endforeach
    </dl>

    <hr>
    <dl>
        <dt>University / School Initiatives</dt>
        @foreach(range(1,10) as $counter)
        @if ($entry->{'initiative'.$counter} !== '')
        <dd><p>{{ $counter }}. {{ $entry->{'initiative'.$counter}  }}</p></dd>
        @endif
        @endforeach
    </dl>

    <hr>
    <dl>
        <dt>Roski Committee Service</dt>
        @foreach(range(1,10) as $counter)
        @if ($entry->{'roski_committee'.$counter} !== '')
        <dd><p>{{ $counter }}. {{ $entry->{'roski_committee'.$counter}  }}</p></dd>
        @endif
        @endforeach
    </dl>

    <hr>
    <dl>
        <dt>Academic Development</dt>
        <dd><p>{{ nl2br($entry->development)  }}</p></dd>
    </dl>

    <hr>
    <dl>
        <dt>Cross-Disciplinary work with other units within USC</dt>
        @foreach(range(1,5) as $counter)
        @if ($entry->{'work'.$counter} !== '')
        <dd><p>{{ $counter }}. {{ $entry->{'work'.$counter}  }}</p></dd>
        @endif
        @endforeach
    </dl>
</div>

<div class="tab-pane fade" id="entry{{ $entry->id }}_mentoring">
    <dl>
        <dt>Peer mentoring - Provide details on your mentoring of other faculty members.</dt>
        <dd><p>{{ nl2br($entry->mentoring)  }}</p></dd>
    </dl>
</div>

<div class="tab-pane fade" id="entry{{ $entry->id }}_accomplishments">
    <dl>
        <dt>Other accomplishments that you feel made a special contribution to the Roski School and/or University.</dt>
        <dd><p>{{ nl2br($entry->accomplishments)  }}</p></dd>
        <dt>Comments on anything else you feel is worthy of consideration for this academic period that has not been indicated above.</dt>
        <dd><p>{{ nl2br($entry->comments)  }}</p></dd>
    </dl>
</div>

<div class="tab-pane fade" id="entry{{ $entry->id }}_media">
    @include('utils.file', ['label' => 'Resume', 'name' => 'resume', 'files' => $entry->existingFiles('resume')])
    <hr>
    <p>Copies of all syllabi you have developed and used for the academic year.</p>
    <dl>
	    @foreach(range(1,8) as $counter)
	    @include('utils.file', ['label' => 'File ' . $counter, 'name' => 'syllabus'.$counter, 'files' => $entry->existingFiles('syllabus'.$counter, 'Syllabus ' . $counter)])
	    @endforeach
    </dl>
</div>