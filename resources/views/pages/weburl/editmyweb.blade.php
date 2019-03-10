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
                            <div class="form-group has-feedback {{ $errors->has('url') ? 'has-error' : '' }}">
                                <input id="url" type="text" class="form-control {{ $errors->has('url') ? ' is-invalid' : '' }}" name="url" value="{{ $urlEdit->url }}" required autofocus>
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

        </div>
    </div>
</section>
@endsection