@extends('layouts.admin-layout')

@section('content')
<section class="content-header">
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-graduation-cap"></i>Profile</a></li>
        <li class="active">My Profile</li>
    </ol>
</section>
<section class="content" style="margin-top:25px;">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 col-xs-offset-0 col-sm-offset-0 col-md-offset-2 col-lg-offset-2 toppad" >


            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title">{{ $profile->name }}</h3>
                    <span data-toggle="modal" data-target="#infoUpdateModal" class="pull-right" style="margin-top: -23px;">     
                        <a data-original-title="Update personal info" data-toggle="tooltip" type="button" class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-edit"></i></a>
                    </span>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <span data-toggle="modal" data-target="#imgchangeModal">
                            <div class="col-md-3 col-lg-3 " align="center"> 
                                <a data-original-title="Update porfile image" data-toggle="tooltip" href="#imgchangeModal">
                                    @if(!is_null($profile->image))
                                        <img alt="User Pic" src="{{url('assets/images/user')}}/{{$profile->image}}" class="img-circle img-responsive">
                                    @else
                                        <img alt="User Pic" src="{{url('assets/images/user/demo.jpg')}}" class="img-circle img-responsive">
                                    @endif
                                </a>
                            </div>
                        </span>
                        
                        <div class=" col-md-9 col-lg-9 "> 
                            <table class="table table-user-information">
                                <tbody>
                                    <tr>
                                        <td>First Name:</td>
                                        <td>{{ $profile->first_name }}</td>
                                    </tr>
                                    <tr>
                                        <td>Last Name:</td>
                                        <td>{{ $profile->last_name }}</td>
                                    </tr>
                                    <tr>
                                        <td>Email Address:</td>
                                        <td>{{$profile->email}}</td>
                                    </tr>
                                    <tr>
                                        <td>Joining Date:</td>
                                        <td>{{ date('d-m-Y', strtotime($profile->created_at)) }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- imgchangeModal -->
    <div class="modal fade" id="imgchangeModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Change your profile Image</h4>
                </div>
                <form action="{{url('/upload-admin-image')}}/{{ $profile->id }}" method="POST" class="form-horizontal demo-form" enctype="multipart/form-data">
                    <div class="modal-body">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <input type="hidden" name="first_name" value="{{ $profile->first_name }}">
                        @if(!is_null($profile->image))
                            <img alt="Profile Image" src="{{url('assets/images/user/'.Session::get('user_image'))}}" class="img-circle img-responsive" id="output" style="margin-left: 175px;" height="160px" width='160px'>
                        @else
                            <img alt="Profile Image" src="{{url('assets/images/user/demo.jpg')}}" class="img-circle img-responsive" id="output" style="margin-left: 175px;" height="160px" width='160px'>
                        @endif

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

    <!-- infoUpdateModal -->
	<div class="modal fade" id="infoUpdateModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Update your Personal info</h4>
                </div>
                <form action="{{url('/update-profile')}}/{{ $profile->id }}" method="POST" class="form-horizontal demo-form" enctype="multipart/form-data">
                    <div class="modal-body">
						<input type="hidden" name="_token" value="{{csrf_token()}}">
                        <table class="table table-user-information">
                            <tbody>
                                <tr>
                                    <td>First Name:</td>
                                    <td><input type="text" name="first_name" class="form-control" value="{{ $profile->first_name }}" required/></td>
                                </tr>
                                <tr>
                                    <td>Last Name:</td>
                                    <td><input type="text" name="last_name" class="form-control" value="{{ $profile->last_name }}" required/></td>
                                </tr>
                                <tr>
                                    <td>Email Address:</td>
                                    <td><input type="text" name="email" class="form-control" value="{{ $profile->email }}" required/></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- infoUpdateModal -->
    @endsection