@extends('layouts.admin-layout')

@section('content')
<section class="content-header">
    <h1>
        Dashboard
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    </ol>
	
</section>
<section class="content" style="margin-top:25px;">
    @hasanyrole('super admin|admin')
	<!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>150</h3>

              <p>New Solution</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
            <h3>150</h3>

              <p>New Topics</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>44</h3>

              <p>New Comments</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>65</h3>

              <p>New User Registration</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->
      @endhasanyrole


    <div class="row">
        <div class="col-md-12">
          <div class="box box-primary">
            <div class="box-header with-border">
              <div class="">
                <!-- form start -->
                <form class="form-horizontal">
                    <div class="box-body">
                        <div class="form-group">
                            <div class="col-sm-1"></div>
                            <label for="inputEmail3" class="col-sm-1 control-label">Standard</label>
                            <div class="col-sm-2">
                            <select name="standard" id="standard" class="form-control standard">
                                <option>Select Standard</standard>
                                @foreach($allStandard as $standard)
                                <option value="{{ $standard->id }}">{{ $standard->name }}</option>
                                @endforeach
                            </select>
                            </div>
                            <label for="inputEmail3" class="col-sm-1 control-label">Subject</label>
                            <div class="col-sm-2">
                              <select name="subject" id="subject_for_dashboard" class="form-control subject_for_dashboard">
                          
                              </select>
                            </div>
                            <label for="inputEmail3" class="col-sm-1 control-label">Chapter</label>
                            <div class="col-sm-2">
                              <select name="chapter" id="chapter_for_dashboard" class="form-control chapter_for_dashboard">
                            
                              </select>
                            </div>
                            <div class="col-sm-2">
                                <!--<button type="submit" class="btn btn-info" style="padding: 3px 12px"><span class="glyphicon glyphicon-search"></span></button> -->
                            </div>
                        </div>
                    </div>
                <!-- /.box-body -->
                </form>
            </div>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              
              <div class="table-responsive mailbox-messages">
                <table class="table table-hover table-striped">
                  <tbody>
                    @foreach($allTopic as $topic)
                    <tr>                    
                      <td class="mailbox-name">{{ $topic->standard->name }}, {{ $topic->subject->name }}, {{ $topic->chapter->chapter_number }} - {{ $topic->chapter->chapter_name }}</td>
                      <td class="mailbox-subject"><a href="{{ url('topic-details') }}/{{ $topic->topic_id }}">{{ $topic->topic }}</a></td>
                      <td class="mailbox-attachment">
                        <span class="badge bg-green">100</span>
                        <span class="badge bg-yellow">100</span>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
                <!-- /.table -->
              </div>
              <!-- /.mail-box-messages -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
                <ul class="pagination pagination-sm no-margin pull-right">
                    <li><a href="#">&laquo;</a></li>
                    <li><a href="#">1</a></li>
                    <li><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <li><a href="#">&raquo;</a></li>
                </ul>
            </div>
          </div>
          <!-- /. box -->
        </div>
        <!-- /.col -->
    </div>
    <!-- row for the dashboard calendar -->
    

</section>
@endsection