@section('title')
Edit User
@endsection

@section('content')

<div class="page-header">
<h1>Edit User</h1>
</div>

{{ Notification::showAll() }}
{{ Form::model($user, ['route' => ['users.update', $user->id], 'class' => 'form-ajax form-validate', 'method' => 'put']) }}

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
			{{ Form::password('password', ['id' => 'user_password', 'class' => 'form-control input-sm', 'required']) }}
			</div>
		</div>
	</div>
	
	<!--
	<div class="form-group">
		<label for="user_rank" class="form-label">Reviewer Type</label>
		<div class="row">
			<div class="col-sm-6">
			{{ Form::select('user_rank',array('TT'=>'TT','NTT'=>'NTT','Adjunct'=>'Adjunct'), null, array('class' => 'form-control', 'id' => 'user_user_rank'))}}
			</div>
		</div>
	</div>
	-->

	<p>
		<input class="btn btn-primary" type="submit" value="Save" data-disable-with="Please wait...">
	</p>

{{ Form::close() }}

@endsection