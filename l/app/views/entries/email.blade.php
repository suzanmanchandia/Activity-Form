{{ Form::open( array('route' => array('entries.email.process', $staff->id), 'method' => 'post', 'class' => 'form-horizontal form-ajax', 'data-bv-excluded' => ':disabled', 'data-toggle' => 'validator', 'data-close' => 'true' ) ) }}

<div class="row">
	<div class="col-md-12">

		<div class="form-group">
			<label for="mail-to" class="control-label col-sm-4">To</label>
			<div class="col-sm-8">
				{{ Form::input('email', 'to', $staff->email, array('class' => 'form-control', 'id' => 'mail-to', 'required', 'maxlength' => 40 ) ) }}
			</div>
		</div>

		<div class="form-group">
			<label for="mail-from" class="control-label col-sm-4">From</label>
			<div class="col-sm-8">
				{{ Form::text('from', $user->first_name . ' ' . $user->last_name, array('class' => 'form-control', 'id' => 'mail-from', 'required', ) ) }}
			</div>
		</div>

		<div class="form-group">
			<label for="mail-sender" class="control-label col-sm-4">Email</label>
			<div class="col-sm-8">
				{{ Form::input('email', 'sender', $user->email, array('class' => 'form-control', 'id' => 'mail-sender', 'required', 'maxlength' => 40 ) ) }}
			</div>
		</div>

		<div class="form-group">
			<label for="mail-subject" class="control-label col-sm-4">Subject</label>
			<div class="col-sm-8">
				{{ Form::text('subject', '', array('class' => 'form-control', 'id' => 'mail-subject', 'required', 'placeholder' => 'Please type the subject' ) ) }}
			</div>
		</div>

		<div class="form-group">
			<label for="mail-message" class="control-label col-sm-4">Message</label>
			<div class="col-sm-8">
				{{ Form::textarea('message', '', array('class' => 'form-control hide', 'id' => 'mail-message', 'required', 'rows' => 3, 'placeholder' => 'Please type the subject' ) ) }}
				<div contenteditable="true" class="form-control" data-link-with="#mail-message"></div>
			</div>
		</div>

	</div>

	<div class="col-md-offset-4 col-md-8">
		<button type="submit" class="btn btn-primary btn-lg">Submit</button>
		<button type="button" class="btn btn-default btn-lg" data-dismiss="modal">Cancel</button>
	</div>
</div>

<div class="clearfix"></div>

{{ Form::close() }}
<script>
	$(function(){
		$('div[contenteditable]').on('keyup change blur', function(){
			$('#mail-message').val($(this).html()).trigger('input');
		});
	});
</script>