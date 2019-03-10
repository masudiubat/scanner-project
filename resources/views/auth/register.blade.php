@extends('layouts.loginlayout')

@section('content')
<div class="login-logo">
    <a href="{{url('/')}}"><b>Scanner</b></a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Register a new membership</p>
    @if($errors->any())
    <div class="alert alert-danger">{{$errors->first()}}</div>
    @endif
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="form-group has-feedback {{ $errors->has('first_name') ? 'has-error' : '' }}">
            <input id="first_name" type="text" class="form-control {{ $errors->has('first_name') ? ' is-invalid' : '' }}" name="first_name" value="{{ old('first_name') }}" placeholder="First Name" required autofocus>
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
            <span class="text-danger">{{ $errors->first('first_name') }}</span>
        </div>

        <div class="form-group has-feedback {{ $errors->has('last_name') ? 'has-error' : '' }}">
            <input id="last_name" type="text" class="form-control {{ $errors->has('last_name') ? ' is-invalid' : '' }}" name="last_name" value="{{ old('last_name') }}" placeholder="Last Name" required>
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
            <span class="text-danger">{{ $errors->first('last_name') }}</span>
        </div>

      <div class="form-group has-feedback {{ $errors->has('email') ? 'has-error' : '' }}">
        <input id="email" type="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="Email" required>
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        <span class="text-danger">{{ $errors->first('email') }}</span>
      </div>

      <div class="form-group has-feedback {{ $errors->has('password') ? 'has-error' : '' }}">
        <input id="password" type="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="Password" required>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        <span class="text-danger">{{ $errors->first('password') }}</span>
      </div>

      <div class="form-group has-feedback {{ $errors->has('password-confirm') ? 'has-error' : '' }}">
        <input id="password-confirm" type="password" class="form-control {{ $errors->has('password-confirm') ? ' is-invalid' : '' }}" name="password_confirmation" placeholder="Confirm Password" required>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        <span class="text-danger">{{ $errors->first('password') }}</span>
      </div>

      <div class="row">
        <div class="col-xs-8">
          
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Register</button>
        </div>
        <!-- /.col -->
      </div>
    </form>
    <!-- /.social-auth-links -->
    <a href="{{url('/login')}}" class="text-center">I already have a membership</a>
  </div>
  <!-- /.login-box-body -->
@endsection