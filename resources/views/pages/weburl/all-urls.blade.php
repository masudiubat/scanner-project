@extends('layouts.admin-layout')

@section('content')
<section class="content-header">
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-graduation-cap"></i>URL Management</a></li>
        <li class="active">All Requests</li>
    </ol>
</section>
<section class="content" style="margin-top:25px;">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                <h3 class="box-title">All request</h3>
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
                        <th>Verification Date</th>
                        <th>Action</th>
                    </tr>
                    @foreach($allUrls as $url)
                    <tr>
                        <td><?php echo $i++; ?></td>
                        <td>{{ $url->url }}</td>
                        <td>{{ $url->user->name }}</td>
                        <td>{{ $url->user->email }}</td>
                        <td>
                            @if($url->verification_status == 'verified')
                                <span class="label label-success">Verified</span>
                            @elseif($url->verification_status == 'denied')
                                <span class="label label-danger">Denied</span>
                            @else 
                                <span class="label label-primary">Pending</span>
                            @endif                            
                        </td>
                        <td> {{ date('d-m-Y', strtotime($url->created_at)) }} </td>
                        <td>
                            @if(is_null($url->verification_date))
                                <span>Not Verified Yet</span>
                            @else 
                            {{ date('d-m-Y', strtotime($url->verification_date)) }}
                            @endif
                        </td>
                        <td>                            
                            <a href="{{url('/delete-url')}}/{{ $url->id }}" title="Delete" data-placement="top" data-toggle="tooltip" data-original-title="Delete" class="btn btn-danger btn-xs confirm"><i class="fa fa-trash" aria-hidden="true"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody></table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->

        </div>
    </div>
</section>
@endsection