@extends('layouts.admin-layout')

@section('content')
<section class="content-header">
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-graduation-cap"></i>Admin</a></li>
        <li class="#">View Admin</li>
        <li class="active">Update Details</li>
    </ol>
</section>
<section class="content" style="margin-top:25px;">
<div class="row">
    <div class="col-md-8 col-md-offset-2">
            <div class="box box-info">
				<div class="box-header with-border">
					<h3 class="box-title">Update Details</h3>
					@if (Session::has('message'))
					<div class="alert alert-info">{{ Session::get('message') }}</div>
					@endif
					@if(Session::has('errmessage'))
					<div class="alert alert-danger">{{ Session::get('errmessage') }}</div>
					@endif
					<div class="pull-right">
                    <a href="{{url('/view-details')}}/{{$adminInfo->id}}" title="View Details" data-placement="top" data-toggle="tooltip" data-original-title="View Details" class="btn btn-info tooltips"><i class="fa fa-eye" aria-hidden="true"></i></a>
					</div>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
				<!-- form start -->
					<form class="form-horizontal" action="{{url('/store-update-info')}}/{{$adminInfo->id}}" method='POST' enctype="multipart/form-data">
						<div class="box-body box-profile">
							<div class="col-md-4">
								<input type="hidden" name="_token" value="{{csrf_token()}}">
								<div class="form-group">
									<div class="col-sm-4 col-sm-offset-4">
										<a href="#myModal" title="Change Image" data-placement="top" data-target="#myModal" data-toggle="modal" data-original-title="View Details" onclick="myFunction()">
											@if(!is_null($adminInfo->profiles->image))
												<img class="profile-user-img img-circle" src="{{url('assets/admin/images/admin')}}/{{$adminInfo->profiles->image}}" id="output"/>
											@else
											<img class="profile-user-img img-circle" src="{{url('assets/admin/images/admin/demo.jpg')}}" id="output"/>
											@endif
										</a>
									</div>
									<div class="col-sm-4"></div>
								</div>								
							</div>
							<div class="col-md-8">								
								<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
									<label for="inputEmail3" class="col-sm-3 control-label">Name</label>
									<div class="col-sm-9"> 
										<input type="text" name="name" value="{{$adminInfo->name}}" class="form-control" id="inputPassword3"/>
										<span class="text-danger">{{ $errors->first('name') }}</span>
									</div>
								</div>
								<div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
									<label for="inputPassword3" class="col-sm-3 control-label">Email</label>
									<div class="col-sm-9">
										<input type="email" name="email" value="{{$adminInfo->email}}" class="form-control" id="inputPassword3"/>
										<span class="text-danger">{{ $errors->first('email') }}</span>
									</div>
								</div>
                                <div class="form-group {{ $errors->has('phone') ? 'has-error' : '' }}">
									<label for="inputPassword3" class="col-sm-3 control-label">Phone</label>
									<div class="col-sm-9">
										<input type="text" name="phone" value="{{$adminInfo->profiles->phone}}" class="form-control" id="inputPassword3"/>
										<span class="text-danger">{{ $errors->first('phone') }}</span>
									</div>
								</div>
                                <div class="form-group {{ $errors->has('father_name') ? 'has-error' : '' }}">
									<label for="inputPassword3" class="col-sm-3 control-label">Father Name</label>
									<div class="col-sm-9">
										<input type="text" name="father_name" value="{{$adminInfo->profiles->father_name}}" class="form-control" id="inputPassword3"/>
										<span class="text-danger">{{ $errors->first('father_name') }}</span>
									</div>
								</div>
                                <div class="form-group {{ $errors->has('mother_name') ? 'has-error' : '' }}">
									<label for="inputPassword3" class="col-sm-3 control-label">Mother Name</label>
									<div class="col-sm-9">
										<input type="text" name="mother_name" value="{{$adminInfo->profiles->mother_name}}" class="form-control" id="inputPassword3"/>
										<span class="text-danger">{{ $errors->first('mother_name') }}</span>
									</div>
								</div>
                                <div class="form-group {{ $errors->has('dob') ? 'has-error' : '' }}">
									<label for="inputPassword3" class="col-sm-3 control-label">Date of Birth</label>
									<div class="col-sm-9">
										<input type="text" name="dob" value="{{$adminInfo->profiles->dob}}" class="form-control" id="inputPassword3"/>
										<span class="text-danger">{{ $errors->first('dob') }}</span>
									</div>
								</div>
                                <div class="form-group pull-right">
                                    <div class="col-sm-12">
									    <button type="submit" class="btn btn-info pull-right">Update</button>
                                    </div>
                                </div>								
							</div>							
						</div>
						<!-- /.box-body -->
						<!-- /.box-footer -->
					</form>
				</div>
				<!-- Modal Start -->
				<div id="myModal" class="modal fade" role="dialog">
					<div class="modal-dialog">
						<!-- Modal content-->
						<div class="modal-content">
							<form class="form-horizontal" action="{{url('/change-admin-image')}}/{{$adminInfo->id}}" method='POST' enctype="multipart/form-data">
								<input type="hidden" name="_token" value="{{csrf_token()}}">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal">&times;</button>
									<h4 class="modal-title">Change Profile Image</h4>
								</div>
								<div class="modal-body">
									<div class="form-group">
										<div class="text-center">
											<div>
												@if(!is_null($adminInfo->profiles->image))
													<img id="modaloutput" class="profile-user-img" src="{{url('assets/admin/images/admin')}}/{{$adminInfo->profiles->image}}" height="100px" width="90px"/>
												@else
													<img id="modaloutput" class="profile-user-img" src="{{url('assets/admin/images/admin/demo.jpg')}}" height="100px" width="90px"/>
												@endif
											</div>
										</div>						
									</div>					
									<div class="form-group">						
										<div class="col-md-offset-4">										
											<input type="file" name="new_profile_image" class="text-center" id="insertImage" accept="image/*" onchange="loadFile(event)" />							
										</div><br/>
									</div>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
									<button type="submit" name="submit" class="btn btn-info">Change Image</button>
								</div>
							</form>
						</div>
					</div>
				</div>
				<!-- Modal End -->


			</div>
    </div>
</div>
</section>
@endsection