@extends('layouts.admin-layout')

@section('content')
<section class="content-header">
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-graduation-cap"></i>User Management</a></li>
        <li class="#">View User</li>
        <li class="active">User Details</li>
    </ol>
</section>
<section class="content" style="margin-top:25px;">
	<div class="row">
        <div class="col-md-3">

          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
				@if(!is_null($userInfo->image))
				<span data-toggle="modal" data-target="#imgchangeModal">
					<a data-original-title="Update porfile image" data-toggle="tooltip" href="#imgchangeModal"><img class="profile-user-img img-responsive img-circle" src="{{url('assets/user/images/user')}}/{{$userInfo->image}}"/></a>
				</span>
					@else
				<span data-toggle="modal" data-target="#imgchangeModal">
					<a data-original-title="Update porfile image" data-toggle="tooltip" href="#imgchangeModal"><img class="profile-user-img img-responsive img-circle" src="{{url('assets/user/images/user/demo.jpg')}}"/></a>
				</span>
				@endif

              <h3 class="profile-username text-center">
					{{ $userInfo->name }}
			  </h3>

              <p class="text-muted text-center">
					@if($userInfo->type == 1)
					Super Admin
					@elseif($userInfo->type == 2)
					Admin
					@else
					Contributor
					@endif
			  </p>

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>Item 1</b> <a class="pull-right">1,322</a>
                </li>
                <li class="list-group-item">
                  <b>Item 2</b> <a class="pull-right">543</a>
                </li>
                <li class="list-group-item">
                  <b>Item 3</b> <a class="pull-right">13,287</a>
                </li>
              </ul>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#activity" data-toggle="tab">Personal Info</a></li>
              <li><a href="#timeline" data-toggle="tab">Timeline</a></li>
              <li><a href="#settings" data-toggle="tab">Settings</a></li>
            </ul>
            <div class="tab-content">
              <div class="active tab-pane" id="activity">
					<div class="pull-right">
						<a href="#userInfoUpdate" id="userInfoUpdateButton" title="Update" data-placement="top" data-target="#userInfoUpdate" data-toggle="modal" data-original-title="Update Information" class="btn btn-info tooltips"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
					</div>
				  	<!-- form start -->
					<form class="form-horizontal" action="#" method='POST' enctype="multipart/form-data">
						<div class="box-body box-profile">
							<div class="col-md-8">							
								<div class="form-group">
									<label for="name" class="col-sm-3 control-label">Name</label>
									<div class="col-sm-9"> 
										<input type="text" name="name" value="{{$userInfo->name}}" class="form-control" id="name" readonly="readonly"/>
									</div>
								</div>
								<div class="form-group">
									<label for="email" class="col-sm-3 control-label">Email</label>
									<div class="col-sm-9">
										<input type="email" name="email" value="{{$userInfo->email}}" class="form-control" id="email" readonly="readonly"/>
									</div>
								</div>
                                <div class="form-group">
									<label for="phone" class="col-sm-3 control-label">Phone</label>
									<div class="col-sm-9">
										<input type="text" name="phone" value="{{$userInfo->mobile}}" class="form-control" id="phone" readonly="readonly"/>
									</div>
								</div>
                                <div class="form-group">
									<label for="gender" class="col-sm-3 control-label">Gender</label>
									<div class="col-sm-9">
										<input type="text" name="gender" value="{{$userInfo->gender}}" class="form-control" id="gender" readonly="readonly"/>
									</div>
								</div>								
							</div>							
						</div>
						<!-- /.box-body -->
						<!-- /.box-footer -->
					</form>	

              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="timeline">
                
              </div>
              <!-- /.tab-pane -->

              <div class="tab-pane" id="settings">
                
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
	  <!-- /.row -->
	  
	  <!-- user info update modal -->
	  <div class="example-modal">
		<div class="modal fade" id="userInfoUpdate">
			<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">User Info Update</h4>
				</div>
				<div class="modal-body">
				<form method="post" action="{{url('/update-own-info')}}/{{ $userInfo->id }}" class="form-horizontal" >
					<input id="csrf_token_userupdate" type="hidden" name="_token" value="{{csrf_token()}}">
					<div class="box-body">
						<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
							<label for="name" class="col-sm-4 control-label">Name</label>

							<div class="col-sm-8">
								<input type="text" name="name" value="{{ $userInfo->name }}" class="form-control" id="name">
								<span class="text-danger">{{ $errors->first('name') }}</span>
							</div>
						</div>
						<div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
							<label for="email" class="col-sm-4 control-label">Email</label>

							<div class="col-sm-8">
								<input type="text" name="email" value="{{ $userInfo->email }}" class="form-control" id="email">
								<span class="text-danger">{{ $errors->first('email') }}</span>
							</div>
						</div>

						<div class="form-group {{ $errors->has('mobile') ? 'has-error' : '' }}">
							<label for="mobile" class="col-sm-4 control-label">Mobile</label>

							<div class="col-sm-8">
								<input type="text" name="mobile" value="{{ $userInfo->mobile }}" class="form-control" id="mobile">
								<span class="text-danger">{{ $errors->first('mobile') }}</span>
							</div>
						</div>

						<div class="form-group">
							<label for="gender" class="col-sm-4 control-label">Gender</label>

							<div class="col-sm-8">
								<input type="text" name="gender" value="{{ $userInfo->gender }}" class="form-control" id="gender">
							</div>
						</div>
						
					</div>
					<div class="modal-footer">
					<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
					<button type="submit" name="submit" class="btn btn-primary">Save changes</button>
					</div>
				</form>
			</div>
			<!-- /.modal-content -->
			</div>
			<!-- /.modal-dialog -->
		</div>
		<!-- /.modal -->
		</div>

		 <!-- /user info update modal -->
		 
		 <!-- imgchangeModal -->
		 <div class="modal fade" id="imgchangeModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
					<div class="modal-content">
							<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
									<h4 class="modal-title">Change your profile Image</h4>
							</div>
							<form action="{{url('/change-own-image/'.$userInfo->id)}}" method="POST" class="form-horizontal demo-form" enctype="multipart/form-data">
									<div class="modal-body">
								<input type="hidden" name="_token" value="{{csrf_token()}}">
											<img alt="User Pic" src="{{url('assets/user/images/user')}}/{{$userInfo->image}}" class="img-circle img-responsive" id="output" style="margin-left: 175px;" height="160px" width='160px'>
											&nbsp;
											&nbsp;

											<input type="file" name="image" id="image" accept="image/*" onchange="loadFile(event)" style="margin-left: 175px;"/>

									</div>
									<div class="modal-footer">
											<input type="submit" name="submit" value="Update" class="btn btn-primary" style="color:white;"/>
									</div>
							</form>
					</div>
			</div>
	</div>
	<!-- imgchangeModal -->



</section>
@endsection