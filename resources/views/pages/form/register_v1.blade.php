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
                        <i class="fa fa-user"></i>
                    </div>
                </div>
                <div class="form-bottom">
                    <div class="text-center"><h3>Create a New Account</h3></div>
                    {{ Form::open(array('route' => array('register.post'), 'class' => 'login-form')) }}
                        <p> {{ bootstrap_alert() }} </p>
                        <div class="form-group">
                            <label class="sr-only">Staff ID</label>
                            {{ Form::text('staff_name', '', array('id' => 'form-staff_name', 'class' => 'form-username form-control', 'placeholder' => 'Name')) }}
                        </div>
                        <div class="form-group">
                            <label class="sr-only">Staff ID</label>
                            {{ Form::text('staff_id', '', array('id' => 'form-staff_id', 'class' => 'form-username form-control', 'placeholder' => 'Staff ID')) }}
                        </div>
                        <div class="form-group">
                            <label class="sr-only" for="password">Password</label>
                            {{ Form::password('password', array('id' => 'form-password', 'class' => 'form-password form-control', 'placeholder' => 'Password')) }}
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <a href="{{ route('login') }}" class="btn btn-success">Login</a>
                            </div>
                            <div class="col-sm-6">
                                <button type="submit" class="btn">Register</button>
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
