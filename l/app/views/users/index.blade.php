@section('title')
Reviewers
@endsection

@section('content')

<div class="page-header">
<h1>Reviewers <a href="{{ route('users.create') }}" class="btn btn-info">New</a></h1>
</div>

{{ Notification::showAll() }}

<div class="table-responsive">

<table class="table table-hover table-striped">
	<thead>
		<tr>
			<th>Name</th>
			<th>Email</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
	@foreach ($users as $user)
	<tr>
		<td>{{ $user->first_name }} {{ $user->last_name }}
		@if ($user->id == Auth::id())
		<span class="label label-info">You</span>
		@endif
		</td>
		<td>{{ $user->email }}</td>
		<td class="text-right">
		<a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary btn-sm">Edit</a>
		<a href="{{ route('users.destroy', $user->id) }}" class="btn btn-danger btn-sm" data-method="delete" data-confirm="Are you sure you want to delete this user?">Delete</a>
		</td>
	</tr>
	@endforeach
	</tbody>
</table>

</div>

@endsection