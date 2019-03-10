@extends('layouts.loginlayout')

@section('content')
<div class="login-logo">
    <a href="{{url('/')}}"><b>Scanner</b></a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Sign in to start your session</p>
    @if($errors->any())
    <div class="alert alert-danger">{{$errors->first()}}</div>
    @endif
    <form method="POST" action="{{ route('login') }}">
        @csrf
      <div class="form-group has-feedback {{ $errors->has('email') ? 'has-error' : '' }}">
        <input id="email" type="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" placeholder="Email" required autofocus>
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        <span class="text-danger">{{ $errors->first('email') }}</span>
      </div>
      <div class="form-group has-feedback {{ $errors->has('password') ? 'has-error' : '' }}">
        <input id="password" type="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="Password" required>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        <span class="text-danger">{{ $errors->first('password') }}</span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

    
    <!-- /.social-auth-links -->

    <a href="#">I forgot my password</a><br>
    <a href="{{url('/register')}}" class="text-center">Register a new membership</a>
  </div>
  <!-- /.login-box-body -->
@endsection