<dt>{{ $label  }}</dt>
@foreach($files as $file)
<iframe src="{{ asset('packages/uploads/'.$file['name'])  }}" view="fit" type="application/pdf" 
      width="600" height="800" frameborder=0></iframe>
<br><br><br>
@endforeach
