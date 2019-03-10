@extends('layouts.admin-layout')

@section('content')
<section class="content-header">
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-graduation-cap"></i>User Management</a></li>
        <li class="active">User List</li>
    </ol>
</section>
<section class="content" style="margin-top:25px;">
    <div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">View Users</h3>
                <!--
                <div class="box-tools">
                    <button type="button" class="btn btn-block btn-success" data-toggle="modal" data-target="#newUserModal"><i class="fa fa-user-plus" aria-hidden="true"></i> New User</button>
                </div>
                -->
            </div>
            <!-- /.box-header -->
            <!-- box-body start -->
            <div class="box-body">
                <!-- table start -->
                <?php $i = 1; ?>
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>SL.</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Image</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($userList as $user)
                        <tr>
                            <td><?php echo $i++; ?></td>
                            <td>{{$user->first_name}}</td>
                            <td>{{$user->last_name}}</td>
                            <td>{{$user->email}}</td>
                            <td>
                                @if(!is_null($user->image))
                                    <img src="{{url('assets/images/user')}}/{{$user->image}}" style='height: 50px; width:50px'>
                                @else
                                    <img src="{{url('assets/images/user/demo.jpg')}}" style='height: 50px; width:50px'>
                                @endif
                            </td>
                            <td  style="min-width:100px;">
                                <!--<a href="{{url('/view-details')}}/{{$user->id}}" title="View Details" data-placement="top" data-toggle="tooltip" data-original-title="View Details" class="btn btn-info tooltips"><i class="fa fa-eye" aria-hidden="true"></i></a> -->
                                <a href="{{url('/update-user')}}/{{$user->id}}" title="Update" data-placement="top" data-toggle="tooltip" data-original-title="Update Information" class="btn btn-info tooltips btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a> &nbsp; &nbsp;
                                <a href="{{url('/delete-user')}}/{{$user->id}}" title="Delete User" data-placement="top" data-toggle="tooltip" data-original-title="Delete User" class="btn btn-danger tooltips confirm btn-xs"><i class="fa fa-trash" aria-hidden="true"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>SL.</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Image</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                </table>
                <!-- table end -->
            </div>
            <!-- /.box-body -->
        </div>
        <!-- Modal for submit new url -->
        <div id="newUserModal" class="modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered">            
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Create New User</h4>
                    </div>
                <form action="{{ route('register') }}" method="POST">
                    <div class="modal-body">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <div class="form-group has-feedback {{ $errors->has('first_name') ? 'has-error' : '' }}">
                        <input id="first_name" type="text" class="form-control {{ $errors->has('first_name') ? ' is-invalid' : '' }}" name="first_name" value="{{old('first_name')}}" placeholder="First Name" required autofocus>
                            <span class="glyphicon glyphicon-user form-control-feedback"></span>
                            <span class="text-danger">{{ $errors->first('first_name') }}</span>
                        </div>

                        <div class="form-group has-feedback {{ $errors->has('last_name') ? 'has-error' : '' }}">
                            <input id="last_name" type="text" class="form-control {{ $errors->has('last_name') ? ' is-invalid' : '' }}" name="last_name" value="{{old('last_name')}}" placeholder="First Name" required>
                            <span class="glyphicon glyphicon-user form-control-feedback"></span>
                            <span class="text-danger">{{ $errors->first('last_name') }}</span>
                        </div>

                        <div class="form-group has-feedback {{ $errors->has('email') ? 'has-error' : '' }}">
                            <input id="email" type="text" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{old('email')}}" placeholder="Email" required>
                            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                            <span class="text-danger">{{ $errors->first('email') }}</span>
                        </div>

                        <div class="form-group has-feedback {{ $errors->has('password') ? 'has-error' : '' }}">
                            <input id="password" type="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="Password" required>
                            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                            <span class="text-danger">{{ $errors->first('password') }}</span>
                        </div>
                        <div class="form-group has-feedback {{ $errors->has('confirm_password') ? 'has-error' : '' }}">
                            <input id="confirm_password" type="password" class="form-control {{ $errors->has('confirm_password') ? ' is-invalid' : '' }}" name="confirm_password" placeholder="Confirm Password" required>
                            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                            <span class="text-danger">{{ $errors->first('confirm_password') }}</span>
                        </div>

                        <div class="form-group">
                            <img id="output" height="120px" width="110px"/>
                        </div>
                        <div class="form-group has-feedback {{ $errors->has('image') ? 'has-error' : '' }}">                            
                            <input id="image" type="file" class="form-control {{ $errors->has('image') ? ' is-invalid' : '' }}" name="image" accept="image/*" onchange="loadFile(event)">
                            <span class="glyphicon glyphicon-picture form-control-feedback"></span>
                            <span class="text-danger">{{ $errors->first('image') }}</span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Create</button>
                    </div>
                </form>
                </div>            
            </div>
        </div>
        <!-- // Modal for submit new url -->



    </div>
    </div>
</section>
@endsection