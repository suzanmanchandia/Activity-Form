@section('title')
Change Password
@endsection

@section('before')
@include('form.nav')
@endsection

@section('content')

<div class="page-header">
<h1>Change Password</h1>
</div>

{{ Notification::showAll() }}
{{ Form::open(['route' => 'staff.password', 'class' => 'form-validate', 'method' => 'put']) }}

	<div class="form-group">
		<label for="staff_old" class="form-label">Old Password</label>
		<div class="row">
			<div class="col-sm-6">
			{{ Form::password('old', ['id' => 'staff_old', 'class' => 'form-control input-sm', 'required']) }}
			</div>
		</div>
	</div>

	<div class="form-group">
		<label for="staff_password" class="form-label">New Password</label>
		<div class="row">
			<div class="col-sm-6">
			{{ Form::password('password', ['id' => 'staff_password', 'class' => 'form-control input-sm', 'required', 'data-bv-identical' => 'true', 'data-bv-identical-field' => 'password_confirmation']) }}
			</div>
		</div>
	</div>

	<div class="form-group">
		<label for="staff_confirm" class="form-label">Confirm</label>
		<div class="row">
			<div class="col-sm-6">
			{{ Form::password('password_confirmation', ['id' => 'staff_confirm', 'class' => 'form-control input-sm', 'required', 'data-bv-identical' => 'true', 'data-bv-identical-field' => 'password']) }}
			</div>
		</div>
	</div>

	<p>
		<input class="btn btn-primary" type="submit" value="Update" data-disable-with="Please wait...">
	</p>

{{ Form::close() }}

@endsection