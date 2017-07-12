@extends ('layouts.auth')

@section ('content')

<div class="top-content">
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-sm-offset-3 form-box">
                <div class="form-top">
                    <div class="form-top-left">
                        <img src="img/logo_prasarana.png" width="270"/>
                        <p>Document Number Generator System</p>
                    </div>
                    <div class="form-top-right">
                        <i class="fa fa-lock"></i>
                    </div>
                </div>
                <div class="form-bottom">
                    <div class="text-center"><h3>Login to Your Account</h3></div>
                    {{ Form::open(array('route' => array('_auth.login.post'), 'class' => 'login-form')) }}
                        <p> {{ bootstrap_alert() }} </p>
                        <div class="form-group">
                            <label class="sr-only" for="email">Username</label>
                            {{ Form::text('email', '', array('id' => 'form-username', 'class' => 'form-username form-control', 'placeholder' => 'Email | Staff ID')) }}
                        </div>
                        <div class="form-group">
                            <label class="sr-only" for="password">Password</label>
                            {{ Form::password('password', array('id' => 'form-password', 'class' => 'form-password form-control', 'placeholder' => 'Password')) }}
                        </div>
                        <div class="form-group">
                            <div class="pull-right"><a href="#"><small>Forgot password?</small></a></div>
                            <label> {{ Form::checkbox('remember', 0, null, ['class' => 'i-checks', 'id' => 'chk_remember', 'onClick' => 'chk_me()']) }} Remember me </label>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <button type="submit" class="btn btn-success">Login</button>
                            </div>
                            <div class="col-sm-6">
                                <a href="{{ route('register') }}" class="btn">Register</a>
                            </div>
                        </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
        <p class="col-sm text"> <small>&copy; 2017 RIM, All Rights Reserved. Developed and hosted by ICTD.</small> </p>
    </div>
</div>
@endsection

<script src="js/custom.js"></script>
