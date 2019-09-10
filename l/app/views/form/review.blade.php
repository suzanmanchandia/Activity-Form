@section('title')
Review - Faculty Activity Form
@endsection

@section('before')
@include('form.nav')
@endsection

@section('content')

<div class="page-header">

<h1>USC Roski Faculty Activity Report - Your Submissions</h1>
</div>


<ul class="nav nav-tabs">
<?php $counter = 0 ?>
@foreach($entries as $entry)
@if($counter >= 1) 
@break
@endif
  <li><a href="#entry{{ $entry->id }}" data-toggle="tab">{{ $entry->period }}</a></li>
  @if($entry->period != 2018) <?php $counter = $counter+1 ?>
  @endif
@endforeach
</ul>
<div class="tab-content form-pane">

<?php $counter = 0 ?>
@foreach($entries as $entry)
@if($counter >= 1) 
@break
@endif
<div class="tab-pane fade" id="entry{{ $entry->id }}">
    <?php $counter = $counter+1 ?>
	<p>
		<!--
		TO REMOVE EDIT BUTTON COMMENT OUT THE FOLLOWING LINE
		-->
		@if($entry->period == 2018)
		<a class="btn btn-warning" href="{{ route('form.edit', $entry->id) }}"><i class="fa fa-file-pdf-o"></i> Edit</a>
		<?php $counter = $counter-1 ?>
		@endif
		<a class="btn btn-success" target="_blank" href="{{ route('form.print', $entry->id) }}"><i class="fa fa-file-pdf-o"></i> Print</a>
	</p>

	<ul class="nav nav-tabs nav-scroll">
	  <li class="active"><a href="#entry{{ $entry->id }}_info" data-toggle="tab">FACULTY INFORMATION</a></li>
	  <li><a href="#entry{{ $entry->id }}_student" data-toggle="tab">TEACHING AND STUDENT-CENTERED ACTIVITIES</a></li>
	  <li><a href="#entry{{ $entry->id }}_pro" data-toggle="tab">PROFESSIONAL WORK</a></li>
	  <li><a href="#entry{{ $entry->id }}_service" data-toggle="tab">SERVICE TO THE SCHOOL AND UNIVERSITY</a></li>
	  <li><a href="#entry{{ $entry->id }}_mentoring" data-toggle="tab">FORMAL PEER-TO-PEER MENTORING</a></li>
	  <li><a href="#entry{{ $entry->id }}_accomplishments" data-toggle="tab">ACCOMPLISHMENTS</a></li>
	  <li><a href="#entry{{ $entry->id }}_media" data-toggle="tab">MEDIA / FILES</a></li>
	</ul>
	<div class="tab-content form-pane">
	@include('entries.info', array('entry' => $entry))
	</div>
</div>
@endforeach

</div>

@endsection

@section('footer')

<script>
$(function(){
	$('.nav-tabs a:first').trigger('click');
});
</script>
@endsection