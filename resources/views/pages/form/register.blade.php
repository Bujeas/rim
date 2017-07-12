@extends ('layouts.auth')

@section ('content')

<div class="middle-box loginscreen animated fadeInDown">
    <div class="row">
        <div class="text-center"><p><img src="img/logo_prasarana.png" width="270"/></p></div>
        <p> {{ bootstrap_alert() }} </p>
        <div class="ibox-content">
            {{ Form::open(array('route' => array('register.post'), 'class' => 'login-form', 'role' => 'form', 'id' => 'form')) }}
                <div class="input-group m-b">
                    <span class="input-group-addon"><i class="fa fa-user"></i></span> {{ Form::text('staff_name', '', array('id' => 'form-staff_name', 'class' => 'form-control', 'placeholder' => 'Name', 'required' => 'required')) }}
                </div>
                <div class="input-group m-b">
                    <span class="input-group-addon"><i class="fa fa-shield"></i></span> {{ Form::text('number', '', array('id' => 'form-staff_id', 'class' => 'form-control', 'placeholder' => 'Staff ID')) }}
                </div>
                <div class="input-group m-b">
                    <span class="input-group-addon"><i class="fa fa-lock"></i></span> {{ Form::password('password', array('id' => 'form-password', 'class' => 'form-control', 'placeholder' => 'Password')) }}
                </div>
                <div class="input-group m-b">
                    <div class="checkbox">
                        <label> 
                            {{ Form::checkbox('agree', 1, false) }} Agree the terms and policy 
                        </label>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary block full-width m-b">Register</button>
                <hr/>
                <p class="text-muted text-center">
                    <small>Already have an account?</small>
                </p>
                <a href="{{ route('login') }}" class="btn btn-sm btn-white btn-block">Login</a>
            {{ Form::close() }}
        </div>
        <br/>
        <div class="row text-center">
            <small>&copy; 2017, RIM. Prasarana Malaysia Berhad All Rights Reserved.</small>
        </div>
    </div>

@endsection