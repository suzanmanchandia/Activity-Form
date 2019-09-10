@section('content')

        <div class="row login-row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Retrieve Password</h3>
                    </div>
                    <div class="panel-body">
                    	{{ Notification::showAll() }}
                        <form role="form" class="form" method="post" action="{{ route('staff.forgot.action')  }}">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="E-mail" name="email" type="email" autofocus required value="{{ Input::old('email')  }}">
                                </div>
                                <p><button class="btn btn-lg btn-success btn-block" type="submit">Submit</button></p>
								<p><a href="{{ route('staff.login') }}">Nevermind, I remember.</a></p>

                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>

@endsection

@section('title')
Faculty Login
@endsection