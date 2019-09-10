<div class="form-group uploader" data-upload-url="{{ route('form.upload', ['field' => $name])  }}" data-delete-url="{{ route('form.upload.remove', ['field' => $name])  }}" data-upload-filters="{{ $filters or 'image/*' }}" data-existing='{{ $existing or '[]' }}'>
	<span class="form-label">{{ $label  }}</span>

	<div class="row">
		<div class="col-sm-8">
			<div class="uploads"></div>
		</div>
	</div>

</div>