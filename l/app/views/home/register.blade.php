@section('content')

        <div class="row login-row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Register</h3>
                    </div>
                    <div class="panel-body">
                    	{{ Notification::showAll() }}
                        <form role="form" class="form" method="post" action="{{ route('register.action')  }}">
                            <fieldset>
                                <div class="form-group">
                                    <label class="control-label" for="first_name">First name</label>
                                    <input class="form-control" placeholder="" name="first_name" type="text" autofocus required value="{{ Input::old('first_name')  }}">
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="last_name">Last name</label>
                                    <input class="form-control" placeholder="" name="last_name" type="text" autofocus required value="{{ Input::old('last_name')  }}">
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="email">E-mail</label>
                                    <input class="form-control" placeholder="" name="email" type="email" autofocus required value="{{ Input::old('email')  }}">
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="password">Password</label>
                                    <input class="form-control" placeholder="" name="password" type="password" required>
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="password_confirmation">Confirm Password</label>
                                    <input class="form-control" placeholder="" name="password_confirmation" type="password" required>
                                </div>
                                <p><button class="btn btn-lg btn-success btn-block" type="submit">Sign Up</button></p>
                                <p><a href="{{ route('staff.login') }}">Login</a></p>

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