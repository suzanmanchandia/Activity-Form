@section('title')
Import Entries
@endsection

@section('content')

<div class="page-header">
<h1>Import</h1>
</div>
{{ Form::open(['route' => 'entries.import.process', 'class' => 'form-ajax form-validate', 'enctype' => 'multipart/form-data']) }}

	<div class="form-group">
		<label for="upload" class="form-label">CSV File</label>
		<div class="row">
			<div class="col-sm-6">
			{{ Form::file('upload',['id' => 'upload', 'required']) }}
			</div>
		</div>
	</div>

	<p>
		<input class="btn btn-primary" type="submit" value="Save" data-disable-with="Please wait...">
	</p>

{{ Form::close() }}


@endsection