<!DOCTYPE HTML>
<html lang="en-US">
<head>
	@include('pertials.user.head')
</head>
<body class="hold-transition skin-blue sidebar-mini">
	<div class="wrapper">
		<!-- Include header -->
			@include('pertials.user.header')
			<!-- Include header -->
			
			<!-- Include sidebar -->
			@include('pertials.user.sidebar')
			<!-- Include sidebar -->
	
		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
			@include('pertials.user.error_and_success_alert')
			@yield('content')
		</div>
		<!-- Content Wrapper. Contains page content -->
		<!-- Include footer -->
			@include('pertials.user.footer')
			<!-- Include footer -->
			
			<!-- Include control sidebar -->
			
			<!-- Include control sidebar -->
	</div>
		@if(isset($customJs))
        @include("pertials.user.js.$customJs")
        @else
			@include('pertials.user.js.default-js')
		@endif
</body>
</html>