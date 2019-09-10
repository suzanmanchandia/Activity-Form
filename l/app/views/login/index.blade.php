@section('title')
Employee Login
@endsection

@section('content')

        <div class="row login-row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                      <h2 class="panel-title">Reviewer Login</h2>
                        <h3 class="panel-title">Please Sign In</h3>
                    </div>
                    <div class="panel-body">
                    	{{ Notification::showAll() }}
                        <form role="form" class="form" method="post" action="{{ route('login.action')  }}">
                            <fieldset>
                                <div class="form-group">

                                    <input class="form-control" placeholder="E-mail" name="email" type="email" autofocus value="{{ Input::old('email')  }}">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Password" name="password" type="password">
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input name="remember" type="checkbox" value="Remember Me">Remember Me
                                    </label>
                                </div>
                                <p><button class="btn btn-lg btn-success btn-block" type="submit">Login</button></p>
                                <p><a href="{{ route('login.forgot') }}">Forgot password?</a></p>
								<p><a href="{{ route('staff.login') }}">Faculty Login</a></p>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>

@endsection