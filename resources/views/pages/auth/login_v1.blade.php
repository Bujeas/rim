@extends ('layouts.auth')

@section ('content')

<div class="middle-box loginscreen animated fadeInDown">
    <div>
        <div>
            <img src="img/logo_prasarana.png" width="300"/>
        </div>
        <h3 class="text-center">Document Number Generator System</h3>
        <p> {{ bootstrap_alert() }} </p>
        {{ Form::open(array('route' => array('_auth.login.post'), 'class' => 'm-t')) }}
            <div class="form-group">
                {{ Form::text('email', '', array('class' => 'form-control', 'placeholder' => 'email@domain.com.my', 'required' => 'required')) }}
            </div>
            <div class="form-group">
                {{ Form::password('password', array('class' => 'form-control', 'placeholder' => 'password', 'required' => 'required')) }}
            </div>
            <div class="form-group">
                <div class="pull-right"><a href="#"><small>Forgot password?</small></a></div>
                <label> {{ Form::checkbox('remember', 0, null, ['class' => 'i-checks', 'id' => 'chk_remember', 'onClick' => 'chk_me()']) }} Remember me </label>
            </div>
            <button type="submit" class="btn btn-primary block full-width m-b">Login</button>
            <p class="text-muted text-center"><small>Do not have an account?</small></p>
            <a class="btn btn-sm btn-white btn-block" href="#">Create an account</a>
        </form>
        {{ Form::close() }}
        <p class="m-t text-center"> <small>&copy; 2017, RIM. All Rights Reserved.<br>Developed and hosted by ICTD.</small> </p>
    </div>
</div>
@endsection

<script src="js/custom.js"></script>