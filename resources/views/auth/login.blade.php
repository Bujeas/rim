@extends('layouts.auth')

@section('content')
<div class="middle-box text-center loginscreen animated fadeInDown">
    <div>
        <div>

            <h1 class="logo-name">IN+</h1>

        </div>
        <h3>Welcome to IN+</h3>
        <p>Perfectly designed and precisely prepared admin theme with over 50 pages with extra new web app views.
            <!--Continually expanded and constantly improved Inspinia Admin Them (IN+)-->
        </p>
        <p>Login in. To see it in action.</p>
        {{ Form::open(array('route' => array('login'), 'class' => 'panel-body wrapper-lg')) }}
            <div class="form-group">
                {{-- <input type="email" class="form-control" placeholder="Username" required=""> --}}
                {{ Form::text('email', '', array('class' => 'form-control', 'placeholder' => 'email@domain.com.my', 'required' => 'required')) }}
            </div>
            <div class="form-group">
                {{ Form::password('password', array('class' => 'form-control', 'placeholder' => 'password', 'required' => 'required')) }}
            </div>
            <button type="submit" class="btn btn-primary block full-width m-b">Login</button>

            <a href="#"><small>Forgot password?</small></a>
            <p class="text-muted text-center"><small>Do not have an account?</small></p>
            <a class="btn btn-sm btn-white btn-block" href="register.html">Create an account</a>
        {{ Form::close() }}
        <p class="m-t"> <small>Inspinia we app framework base on Bootstrap 3 &copy; 2014</small> </p>
    </div>
</div>
@endsection
