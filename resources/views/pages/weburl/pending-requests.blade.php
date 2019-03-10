@extends('layouts.admin-layout')

@section('content')
<section class="content-header">
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-graduation-cap"></i>URL Management</a></li>
        <li class="active">Pending Requests</li>
    </ol>
</section>
<section class="content" style="margin-top:25px;">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                <h3 class="box-title">Pending request List</h3>
                @if (Session::has('message'))
                    <div class="alert alert-danger">{{ Session::get('message') }}</div>
                @endif
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                <?php $i = 1; ?>
                <table class="table table-hover">
                    <tbody><tr>
                        <th>Sl.</th>
                        <th>Url</th>
                        <th>Sender Name</th>
                        <th>Sender Email</th>
                        <th>Verification Status</th>
                        <th>Submit Date</th>
                        <th>Action</th>
                    </tr>
                    @foreach($urls as $url)
                    <tr>
                        <td><?php echo $i++; ?></td>
                        <td>{{ $url->url }}</td>
                        <td>{{ $url->user->name }}</td>
                        <td>{{ $url->user->email }}</td>
                        <td>
                            @if($url->verification_status == 'approved')
                                <span class="label label-success">Approved</span>
                            @elseif($url->verification_status == 'denied')
                                <span class="label label-danger">Denied</span>
                            @else 
                                <span class="label label-primary">Pending</span>
                            @endif                            
                        </td>
                        <td> {{ date('d-m-Y', strtotime($url->created_at)) }} </td>
                        <td>
                            <a href="{{url('/verifiy-url')}}/{{ $url->id }}" class="btn btn-success btn-xs verificationconfirm" title="Verify" data-placement="top"><i class="fa fa-check-square" aria-hidden="true"></i></a> &nbsp; &nbsp;
                            <a href="{{url('/delete-url')}}/{{ $url->id }}" title="Delete" data-placement="top" data-toggle="tooltip" data-original-title="Delete" class="btn btn-danger btn-xs confirm"><i class="fa fa-trash" aria-hidden="true"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody></table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->

            <!-- Modal for update url -->
            <div id="editUrlModal" class="modal fade" role="dialog">
                <div class="modal-dialog modal-dialog-centered">            
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Update URL</h4>
                        </div>
                    <form action="{{url('/edit-url')}}" method="POST">
                        <div class="modal-body">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <input type="hidden" name="urlid" id="urlid">
                            <div class="form-group has-feedback {{ $errors->has('url') ? 'has-error' : '' }}">
                                <input id="url" type="text" class="form-control {{ $errors->has('url') ? ' is-invalid' : '' }}" name="url" required autofocus>
                                <span class="glyphicon glyphicon-link form-control-feedback"></span>
                                <span class="text-danger">{{ $errors->first('url') }}</span>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                    </div>            
                </div>
            </div>
            <!-- // Modal for update url -->

            <!-- Modal for Confirmation verification -->
            <div id="confirmationModal" class="modal fade" role="dialog">
                <div class="modal-dialog modal-dialog-centered">            
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Confirmation</h4>
                        </div>
                    <form action="{{url('/verification-confirmation')}}" method="POST">
                        <div class="modal-body">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <input type="hidden" name="urlid" id="urlid" value="{{ Session::get('data') }}"> 
                            <p class="alert alert-info">There is a .txt file has found in this domain which has contain the same name and keys that system has generated.</p>                           
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Verified</button>
                        </div>
                    </form>
                    </div>            
                </div>
            </div>
            <!-- // Modal for update url -->
        </div>
    </div>
</section>
@endsection