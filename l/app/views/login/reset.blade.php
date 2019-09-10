@section('content')

        <div class="row login-row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Reset Password</h3>
                    </div>
                    <div class="panel-body">
                    	{{ Notification::showAll() }}
                        <form role="form" class="form" method="post" action="{{ route('login.reset.action')  }}">
                            <fieldset>
                                <div class="form-group">
                                <input type="hidden" name="token" value="{{ $token }}">
                                    <input class="form-control" placeholder="E-mail" name="email" type="email" autofocus required value="{{ Input::old('email')  }}">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Password" name="password" type="password" autofocus required>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Password Confirmation" name="password_confirmation" type="password" autofocus required>
                                </div>
                                <p><button class="btn btn-lg btn-success btn-block" type="submit">Reset Password</button></p>
								<p><a href="{{ route('login') }}">Nevermind, I remember.</a></p>

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