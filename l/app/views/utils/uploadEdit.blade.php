<div class="form-group uploader" data-upload-url="{{ route('form.upload.edit', ['field' => $name,'id' => $id])  }}" data-delete-url="{{ route('form.upload.remove.edit', ['field' => $name, 'id' => $id])  }}" data-upload-filters="{{ $filters or 'image/*' }}" data-existing='{{ $existing or '[]' }}'>
	<span class="form-label">{{ $label  }}</span>

	<div class="row">
		<div class="col-sm-8">
			<div class="uploads"></div>
		</div>
	</div>
	@if ($files) :
		<p><a class="btn btn-primary btn-xs" href="{{ asset('packages/uploads/'.$files[0]['name'])  }}" target="_blank">View</a> </p>
	@endif
</div>