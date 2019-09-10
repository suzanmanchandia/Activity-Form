@section('title')
Entries
@endsection

@section('content')

<div class="page-header">
<h1>Review</h1>
</div>

<div class="row">

<div class="col-sm-3">
<ul class="nav nav-pills nav-justified">
  <li class="active"><a href="#entry_complete" data-toggle="tab">Complete</a></li>
  <li><a href="#entry_progress" data-toggle="tab">In Progress</a></li>
</ul>

<hr>

<div class="tab-content form-pane">

	<div class="tab-pane fade in active" id="entry_complete">
		<div class="panel panel-default">
			<div class="panel-heading">Faculty</div>
			<div class="panel-body">
				<p><input type="search" class="form-control" data-filter=".list-group" data-items=".list-group-item" placeholder="Search"></p>
			</div>
			<div class="list-group">
			@foreach ($staff as $item)
			<div class="list-group-item" data-load="{{ route('entries.show', $item->id) }}" data-target="#entry-info">
				<h4 class="list-group-item-heading">{{ $item->first_name }} {{ $item->last_name }}</h4>
				<p class="list-group-item-text">{{ $item->email }}</p>
			</div>
			@endforeach
			</div>
		</div>
	</div>
	<div class="tab-pane fade" id="entry_progress">
		<div class="panel panel-default">
			<div class="panel-heading">Faculty</div>
			<div class="panel-body">
				<p><input type="search" class="form-control" data-filter=".list-group" data-items=".list-group-item" placeholder="Search"></p>
			</div>
			<div class="list-group">
			@foreach ($progress as $item)
			<div class="list-group-item" data-load2="{{ route('entries.show', $item->id) }}" data-target="#entry-info">
				<a class="pull-right fa fa-envelope" href="javascript:;" data-dialog="true" data-href="{{ route('entries.email', $item->id) }}" data-toggle="tooltip" title="Send Email"></a>
				<h4 class="list-group-item-heading">{{ $item->first_name }} {{ $item->last_name }}</h4>
				<p class="list-group-item-text">
				<small>Updated {{ $item->currentEntry()->updated_at->format('F d, Y \a\t g:i A') }}</small>
				</p>
			</div>
			@endforeach
			</div>
		</div>
	</div>

</div>


</div>

<div class="col-sm-9" id="entry-info"></div>

</div>

@endsection

@section('footer')
@include('entries.comments.template')
<script>
var commentsTemplate = Handlebars.compile($('#comments-template').html());
</script>
@endsection