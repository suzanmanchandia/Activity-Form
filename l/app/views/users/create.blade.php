@section('title')
Add User
@endsection

@section('content')

<div class="page-header">
<h1>Add User</h1>
</div>

{{ Notification::showAll() }}
{{ Form::open(['route' => 'users.store', 'class' => 'form-ajax form-validate']) }}

	<div class="form-group">
		<label for="user_first_name" class="form-label">First Name</label>
		<div class="row">
			<div class="col-sm-6">
			{{ Form::text('first_name', null, ['id' => 'user_first_name', 'class' => 'form-control input-sm', 'required']) }}
			</div>
		</div>
	</div>
	
	<div class="form-group">
		<label for="user_last_name" class="form-label">Last Name</label>
		<div class="row">
			<div class="col-sm-6">
			{{ Form::text('last_name', null, ['id' => 'user_last_name', 'class' => 'form-control input-sm', 'required']) }}
			</div>
		</div>
	</div>
	
	<div class="form-group">
		<label for="user_email" class="form-label">Email</label>
		<div class="row">
			<div class="col-sm-6">
			{{ Form::input('email', 'email', null, ['id' => 'user_email', 'class' => 'form-control input-sm', 'required']) }}
			</div>
		</div>
	</div>
	
	<div class="form-group">
		<label for="user_password" class="form-label">Password</label>
		<div class="row">
			<div class="col-sm-6">
			{{ Form::password('password', ['id' => 'user_password', 'class' => 'form-control input-sm', 'required', 'data-bv-identical' => 'true', 'data-bv-identical-field' => 'password_confirmation']) }}
			</div>
		</div>
	</div>
	
	<div class="form-group">
		<label for="user_confirm" class="form-label">Confirm</label>
		<div class="row">
			<div class="col-sm-6">
			{{ Form::password('password_confirmation', ['id' => 'user_confirm', 'class' => 'form-control input-sm', 'required', 'data-bv-identical' => 'true', 'data-bv-identical-field' => 'password']) }}
			</div>
		</div>
	</div>	

	<div class="form-group">
		<label for="user_rank" class="form-label">Reviewer Type</label>
		<div class="row">
			<div class="col-sm-6">
			<!--
			{{ Form::password('password_confirmation', ['id' => 'user_confirm', 'class' => 'form-control input-sm', 'required', 'data-bv-identical' => 'true', 'data-bv-identical-field' => 'password']) }}
			-->
			{{ Form::select('user_rank',array('Tenure'=>'Tenure','Teaching'=>'Teaching', 'Practice'=>'Practice'), null, array('class' => 'form-control', 'id' => 'entry_rank'))}}
			</div>
		</div>
	</div>

	<p>
		<input class="btn btn-primary" type="submit" value="Save" data-disable-with="Please wait...">
	</p>

{{ Form::close() }}

@endsection