@extends ('layouts.auth')

@section ('content')

<div class="middle-box loginscreen animated fadeInDown">
    <div class="row">
    	<div class="text-center"><p><img src="img/logo_prasarana.png" width="270"/></p></div>
    	<p> {{ bootstrap_alert() }} </p>
        <div class="ibox-content">
            {{ Form::open(array('route' => array('_auth.login.post'), 'class' => 'login-form', 'id' => 'form')) }}
                <div class="input-group m-b">
                    <span class="input-group-addon"><i class="fa fa-user"></i></span> {{ Form::text('email', '', array('id' => 'form-control', 'class' => 'form-username form-control', 'placeholder' => 'Username', 'required' => 'required')) }}
                </div>
                <div class="input-group m-b">
                    <span class="input-group-addon"><i class="fa fa-lock"></i></span> {{ Form::password('password', array('id' => 'form-password', 'class' => 'form-control', 'placeholder' => 'Password', 'required' => 'required')) }}
                </div>
                <div class="form-group">
                    <div class="pull-right">
                        <a href="#" class="text-muted"><small>Forgot password?</small></a>
                    </div>
                    <div class="checkbox">
                        <label> {{ Form::checkbox('remember', 0, null, ['id' => 'chk_remember', 'onClick' => 'chk_me()']) }} Remember me </label>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary block full-width m-b">Login</button>
                <hr/>
                <p class="text-muted text-center">
                    <small>Do not have an account?</small>
                </p>
                <a href="{{ route('register') }}" class="btn btn-sm btn-white btn-block">Create an account</a>
            {{ Form::close() }}
        </div>
    </div>
    <br/>
    <div class="row text-center">
        <small>&copy; 2017, RIM. Prasarana Malaysia Berhad All Rights Reserved.</small>
    </div>
</div>

@endsection