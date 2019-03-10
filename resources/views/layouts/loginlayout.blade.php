<!DOCTYPE html>
<html>
<head>
  @include('pertials.head')
</head>
<body class="hold-transition login-page">
<div class="login-box">
  @yield('content')
</div>
<!-- /.login-box -->

<!-- jQuery 2.2.3 -->
@if(isset($customJs))
    @include("pertials.user.js.$customJs")
@else
    @include('pertials.user.js.default-js')
@endif

</body>
</html>
