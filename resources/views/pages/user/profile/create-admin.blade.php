@extends('layouts.admin-layout')

@section('content')
<section class="content-header">
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-graduation-cap"></i>User Management</a></li>
        <li class="active">New User</li>
    </ol>
</section>
<section class="content" style="margin-top:25px;">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">New User</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <!-- form start -->
                    <form class="form-horizontal" action="{{url('/store-user')}}" method='POST' enctype="multipart/form-data">
                        <div class="box-body box-profile">
                            <div class="row">
								<div class="col-md-12">
									<input type="hidden" name="_token" value="{{csrf_token()}}">

									<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
										<label for="name" class="col-sm-3 control-label">Name <span class="text-danger"> * </span></label>
										<div class="col-sm-9"> 
											<input type="text" name="name" value="{{old('name')}}" class="form-control" id="name" />
											<span class="text-danger">{{ $errors->first('name') }}</span>
										</div>
									</div>
									<div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
										<label for="email" class="col-sm-3 control-label">Email <span class="text-danger"> * </span></label>
										<div class="col-sm-9">
											<input type="email" name="email" value="{{old('email')}}" class="form-control" id="email" />
											<span class="text-danger">{{ $errors->first('email') }}</span>
										</div>
									</div>
									<div class="form-group {{ $errors->has('mobile') ? 'has-error' : '' }}">
										<label for="phone" class="col-sm-3 control-label">Mobile</label>
										<div class="col-sm-9"> 
											<input type="text" name="mobile" value="{{old('mobile')}}" class="form-control" id="mobile" />
											<span class="text-danger">{{ $errors->first('mobile') }}</span>
										</div>
									</div>
									<div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
										<label for="password" class="col-sm-3 control-label">Password <span class="text-danger"> * </span></label>
										<div class="col-sm-9">
											<input type="password" name="password" class="form-control" id="password" />
											<span class="text-danger">{{ $errors->first('password') }}</span>
										</div>
									</div>
									<div class="form-group {{ $errors->has('repassword') ? 'has-error' : '' }}">
										<label for="repassword" class="col-sm-3 control-label">Conf Password <span class="text-danger"> * </span></label>
										<div class="col-sm-9">
											<input type="password" name="repassword" class="form-control" id="repassword" />
											<span class="text-danger">{{ $errors->first('repassword') }}</span>
										</div>
									</div>
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-3 control-label">Gender</label>
										<div class="col-sm-9"> 
										<select name="gender" class="form-control" id="gender">
											<option value="Male">Male</option>
											<option value="Female">Female</option>
										</select>
										</div>
									</div>
									<div class="form-group">
										<div class="col-sm-4 col-sm-offset-4">
											<img id="output" height="150px" width="150px"/>
										</div>
										<div class="col-sm-4"></div>
									</div>
									<div class="form-group {{ $errors->has('image') ? 'has-error' : '' }}">
										<label for="image" class="col-sm-3 control-label">Image </label>
										<div class="col-sm-9">
											<input type="file" name="image" class="" id="insertImage" accept="image/*" onchange="loadFile(event)" />
											<span class="text-danger">{{ $errors->first('image') }}</span>
										</div>
									</div>
								</div>
							</div>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <button type="submit" name="submit" class="btn btn-info pull-right">Create</button>
                        </div>
                        <!-- /.box-footer -->
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection