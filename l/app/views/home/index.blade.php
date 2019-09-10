@section('content')

        <div class="row login-row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                    <h2 class="panel-title">Faculty Login</h2>
                        <h3 class="panel-title">Please Sign In</h3>
                    </div>
                    <div class="panel-body">
                    	{{ Notification::showAll() }}
                        <form role="form" class="form" method="post" action="{{ route('staff.login.action')  }}">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="E-mail" name="email" type="email" autofocus required value="{{ Input::old('email')  }}">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Password" name="pin" type="password" required>
                                </div>
                                <p><button class="btn btn-lg btn-success btn-block" type="submit">Login</button></p>
                                <p><a href="{{ route('staff.forgot') }}">Forgot password?</a></p>
                                <p><a href="{{ route('register') }}">Register</a></p>
								<p><a href="{{ route('login') }}">Reviewer Login</a></p>

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