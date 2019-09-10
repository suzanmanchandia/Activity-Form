
<h2>{{ $staff->first_name }} {{ $staff->last_name }}
				<a class="btn btn-info btn-sm" href="javascript:;" data-dialog="true" data-href="{{ route('entries.email', $staff->id) }}"><i class="fa fa-envelope"></i> Send Email</a></h2>

<ul class="nav nav-tabs">
@foreach($entries as $entry)
  <li><a href="#entry{{ $entry->id }}" data-toggle="tab">{{ $entry->period }}</a></li>
@endforeach
</ul>

<div class="tab-content form-pane">

@foreach($entries as $entry)
<div class="tab-pane fade" id="entry{{ $entry->id }}">

	<p>
		<a class="btn btn-success" target="_blank" href="{{ route('entries.print', $entry->id) }}"><i class="fa fa-file-pdf-o"></i>Print</a>
		&nbsp;&nbsp;
		<a class="btn btn-success" target="_blank" href="{{ route('entries.preview', $entry->id) }}"><i class="fa fa-file-pdf-o"></i>Preview</a>
	</p>

	<ul class="nav nav-tabs nav-scroll">
	  <li class="active"><a href="#entry{{ $entry->id }}_info" data-toggle="tab">FACULTY INFORMATION</a></li>
	  <li><a href="#entry{{ $entry->id }}_student" data-toggle="tab">TEACHING AND STUDENT-CENTERED ACTIVITIES</a></li>
	  <li><a href="#entry{{ $entry->id }}_pro" data-toggle="tab">PROFESSIONAL WORK</a></li>
	  <li><a href="#entry{{ $entry->id }}_service" data-toggle="tab">SERVICE TO THE SCHOOL AND UNIVERSITY</a></li>
	  <li><a href="#entry{{ $entry->id }}_mentoring" data-toggle="tab">FORMAL PEER-TO-PEER MENTORING</a></li>
	  <li><a href="#entry{{ $entry->id }}_accomplishments" data-toggle="tab">ACCOMPLISHMENTS</a></li>
	  <li><a href="#entry{{ $entry->id }}_media" data-toggle="tab">MEDIA / FILES</a></li>
	  <li class="pull-right"><a href="#entry{{ $entry->id }}_comments" data-toggle="tab">COMMENTS <span class="badge" id="comments-count">{{ $entry->comments()->count()  }}</span></a></li>
	</ul>
	<div class="tab-content form-pane">
		@include('entries.info', array('entry' => $entry))
		<div class="tab-pane fade" id="entry{{ $entry->id }}_comments">
			@include('entries.comments.single', array('entry' => $entry))
		</div>
	</div>

</div>
@endforeach
</div>

<script>
$(function(){
	$('.nav-tabs a:first').trigger('click');
	var $comments = {{ json_encode($entry->formattedComments()) }};

	for (var i=0;i<$comments.length;i++)
	{
		$('#comments_list').append(commentsTemplate($comments[i]));
	}

    $('.comments-form').on('contentUpdate', function(e, data){
        $comments.push(data.comment);
        $('#comments_list').append(commentsTemplate(data.comment));
        $('#comments-count').text($comments.length);
        $('#comments').val('');
    });

});
</script>