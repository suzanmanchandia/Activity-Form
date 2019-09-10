{{ Form::open(array('route' => ['entries.comments', $entry->id], 'class' => 'form-ajax well comments-form')) }}

<div class="form-group">
	<label for="comments">
	Add a Comment
	</label>
	<textarea name="content" id="comments" cols="200" rows="3" class="form-control" required></textarea>
</div>

<p class="text-right">
<input type="submit" value="Submit" data-disable-with="Sending..." class="btn btn-info">
</p>

{{ Form::close() }}

<div id="comments_list"></div>