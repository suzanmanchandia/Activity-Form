<!DOCTYPE HTML>
<html>
<head>
    <style>
        body {
            font-family: sans-serif;
            font-size: 13px;
            color: #222;
        }
        dt {
            font-weight: bold;
            color: #000;
        }
        dd {
            margin: 0 0 0.5em;
            padding: 0;
        }
    </style>
</head>
<body>
<h1>{{ $entry->staff->first_name }} {{ $entry->staff->last_name }}</h1>

<dl>
    <dt>Rank</dt>
    <dd><p>{{ $entry->rank }}</p></dd>
    <dt>Title</dt>
    <dd><p>{{ $entry->title }}</p></dd>
    <dt>Period Covered: January 1 - December 31</dt>
    <dd><p>{{ $entry->period }}</p></dd>
</dl>
        <div class="tab-pane fade" id="entry{{ $entry->id }}_student">
        <hr>
        <h4>TEACHING AND STUDENT-CENTERED ACTIVITIES</h4>

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
                <p>
                    Commencement Ceremony
                    @if ($entry->student_events_commencement_ceremony)
                    YES
                    @else
                    NO
                    @endif
                </p>
            </dd>
            <dd>
                <p>
                    Student Shows at Fisher Museum
                    @if ($entry->student_events_fisher_museum)
                    YES
                    @else
                    NO
                    @endif
                </p>
            </dd>
            <dd>
                <p>
                    Undergraduate Open Studios
                    @if ($entry->student_events_undergradute_open_studios)
                    YES
                    @else
                    NO
                    @endif
                </p>
            </dd>
            <dd>
                <p>
                    MFA Open Studios
                    @if ($entry->student_events_mfa_open_studios)
                    YES
                    @else
                    NO
                    @endif
                </p>
            </dd>
            <dd>
                <p>
                    Number of Lindhurst Gallery exhibitions attended: {{nl2br($entry->student_events_lindhurst_gallery_exhibitions)}}
                </p>
            </dd>
            <dd>
                <p>
                    Number of MFA exhibitions attended: {{nl2br($entry->student_events_mfa_exhibitions)}}
                </p>
            </dd>
            <dd>
                <p>
                    Number of MA exhibitions attended: {{nl2br($entry->student_events_ma_exhibitions)}}
                </p>
            </dd>
            <dt>Additional Student Events</dt>
            <dd><p>{{ nl2br($entry->additional_student_events)  }}</p></dd>
        </dl>
        </div>

        <div class="tab-pane fade" id="entry{{ $entry->id }}_pro">
        <hr>
        <h4>PROFESSIONAL WORK</h4>

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

        <hr>
        <h4>SERVICE TO THE SCHOOL AND UNIVERSITY</h4>

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
<hr>
        <h4>FORMAL PEER-TO-PEER MENTORING</h4>
        <dl>
            <dt>Peer mentoring - Provide details on your mentoring of other faculty members.</dt>
            <dd><p>{{ nl2br($entry->mentoring)  }}</p></dd>
        </dl>
</div>

        <div class="tab-pane fade" id="entry{{ $entry->id }}_accomplishments">
        <hr>
        <h4>ACCOMPLISHMENTS / OTHER</h4>

        <dl>
            <dt>Other accomplishments that you feel made a special contribution to the Roski School and/or University.</dt>
            <dd><p>{{ nl2br($entry->accomplishments)  }}</p></dd>
            <dt>Comments on anything else you feel is worthy of consideration for this academic period that has not been indicated above.</dt>
            <dd><p>{{ nl2br($entry->comments)  }}</p></dd>
        </dl>
        </div>

        <div class="tab-pane fade" id="entry{{ $entry->id }}_media">
        <hr>
        <h4>MEDIA / FILES</h4>

        @include('utils.file', ['label' => 'Resume', 'name' => 'resume', 'files' => $entry->existingFiles('resume')])
        
        <hr>

        <p>Copies of all syllabi you have developed and used for the academic year.</p>

        <dl>
        @foreach(range(1,8) as $counter)

        @include('utils.file', ['label' => 'File ' . $counter, 'name' => 'syllabus'.$counter, 'files' => $entry->existingFiles('syllabus'.$counter, 'Syllabus ' . $counter)])

        @endforeach
        </dl>
        </div>

</body>
</html>