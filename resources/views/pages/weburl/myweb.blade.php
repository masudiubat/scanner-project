@extends('layouts.admin-layout')

@section('content')
<section class="content-header">
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-graduation-cap"></i>URL Management</a></li>
        <li class="active">My Url</li>
    </ol>
</section>
<section class="content" style="margin-top:25px;">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                <h3 class="box-title">URL List</h3>
                
                <div class="box-tools">
                    <button type="button" class="btn btn-block btn-success" data-toggle="modal" data-target="#newUrlModal">New URL</button>
                </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                <?php $i = 1; ?>
                <table class="table table-hover">
                    <tbody><tr>
                        <th>Sl.</th>
                        <th>Url</th>
                        <th>Verification Status</th>
                        <th>Verification Date</th>
                        <th>Submit Date</th>
                        <th>Action</th>
                    </tr>
                    @foreach($urls as $url)
                    <tr>
                        <td><?php echo $i++; ?></td>
                        <td>{{ $url->url }}</td>
                        <td>
                            @if($url->verification_status == 'verified')
                                <span class="label label-success">Verified</span>
                            @elseif($url->verification_status == 'denied')
                                <span class="label label-danger">Denied</span>
                            @else 
                                <span class="label label-primary">Pending</span>
                            @endif                            
                        </td>
                        <td>
                            @if(is_null($url->verification_date))
                                <span>Not Verified Yet</span>
                            @else 
                            {{ date('d-m-Y', strtotime($url->verification_date)) }}
                            @endif
                        </td>
                        <td> {{ date('d-m-Y', strtotime($url->created_at)) }} </td>
                        <td>
                            @if($url->verification_status == 'pending')
                            <a href="{{url('/download-txt-file')}}/{{ $url->id }}" title="Download txt file" data-placement="top" data-toggle="tooltip" data-original-title="Delete" class="btn btn-success btn-xs preventsubmission"><i class="fa fa-download" aria-hidden="true"></i></i></a>&nbsp; &nbsp;
                            
                            <!-- <button type="button" class="btn btn-success btn-xs" data-url="{{$url->url}}" data-toggle="modal" data-target="#editUrlModal" title="Edit URL" data-placement="top"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button> &nbsp; &nbsp; -->
                            @endif
                            <a href="{{url('/delete-url')}}/{{ $url->id }}" title="Delete" data-placement="top" data-toggle="tooltip" data-original-title="Delete" class="btn btn-danger btn-xs confirm"><i class="fa fa-trash" aria-hidden="true"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody></table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->

            <!-- Modal for submit new url -->
            <div id="newUrlModal" class="modal fade" role="dialog">
                <div class="modal-dialog modal-dialog-centered">            
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Submit New URL</h4>
                        </div>
                    <form action="{{url('/submit-new-url')}}" method="POST">
                        <div class="modal-body">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <div class="form-group has-feedback {{ $errors->has('url') ? 'has-error' : '' }}">
                                <input id="url1" type="text" class="form-control {{ $errors->has('url') ? ' is-invalid' : '' }}" name="url" placeholder="URL" required autofocus>
                                <span class="glyphicon glyphicon-link form-control-feedback"></span>
                                <span class="text-danger">{{ $errors->first('url') }}</span>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                    </div>            
                </div>
            </div>
            <!-- // Modal for submit new url -->

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
                                <input id="url2" type="text" class="form-control {{ $errors->has('url') ? ' is-invalid' : '' }}" name="url" required autofocus>
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
            <div id="generateVerificationKeyModal" class="modal fade" role="dialog">
                <div class="modal-dialog modal-dialog-centered">            
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                        <h4 class="modal-title">Generate verify.txt file</h4>
                        </div>
                    <form action="{{url('/generate-verifytxt')}}" method="POST">
                        <div class="modal-body">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <input type="hidden" name="urlid" id="urlid1" value="{{ Session::get('newDomainId') }}"> 
                            <p class="alert alert-info">
                                Your domain name has submitted successfully. Now after clicking ok button you will get verify.txt file which you will need upload your site then we will verify your submitted link. 
                            </p>                           
                        </div>
                        <div class="modal-footer">
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