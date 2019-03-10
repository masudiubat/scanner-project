<header class="main-header">
    <!-- Logo -->
    <a href="index2.html" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>A</b>Pnl</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Admin</b>Panel</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            @if(Session::has('user_image'))
              <img src="{{url('assets/images/user/'.Session::get('user_image'))}}" height="160px" width='160px' class="user-image" alt="User Image">
            @else
              <img src="{{url('assets/images/user/demo.jpg')}}" height="160px" width='160px' class="user-image" alt="User Image">
            @endif  
              <span class="hidden-xs">
                {{ Auth::user()->name }}
              </span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                @if(Session::has('user_image'))
                  <img src="{{url('assets/images/user/'.Session::get('user_image'))}}" class="img-circle" alt="User Image">
                @else
                  <img src="{{url('assets/images/user/demo.jpg')}}" class="img-circle" alt="User Image">
                @endif
                <p>
                {{ Auth::user()->name }}
                </p>
              </li>
              <!-- Menu Body -->
              <li class="user-body">
                <div class="row">
                  <div class="text-center">
                    <a href="#changePasswordModal" id="changePasswordModalButton" data-target="#changePasswordModal" data-toggle="modal" data-original-title="Chagne Password"><i class="fa fa-key"></i> <br/> Change Password</a>
                  </div>
                </div>
                <!-- /.row -->
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="{{url('view-my-profile')}}/{{ Auth::user()->id }}" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="{{ route('logout') }}" class="btn btn-default btn-flat" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Sign out</a>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                      @csrf
                  </form>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          
        </ul>
      </div>
    </nav>  
  </header>

  <!-- Change password Modal -->
  <div class="example-modal">
        <div class="modal fade" id="changePasswordModal">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Change Password</h4>
              </div>
              <div class="modal-body">

                <form method="post" action="{{url('/change-own-password')}}/{{ Session::get('user_id') }}" class="form-horizontal" >
                  <input id="csrf_token" type="hidden" name="_token" value="{{csrf_token()}}">
                    <div class="box-body">
                      <div class="form-group {{ $errors->has('new_password') ? 'has-error' : '' }}">
                        <label for="inputEmail3" class="col-sm-4 control-label">New Password</label>

                        <div class="col-sm-8">
                          <input type="password" name="new_password" class="form-control" id="inputEmail3" placeholder="New Password">
                          <span class="text-danger">{{ $errors->first('new_password') }}</span>
                        </div>
                      </div>
                      <div class="form-group {{ $errors->has('conf_new_password') ? 'has-error' : '' }}">
                        <label for="inputPassword3" class="col-sm-4 control-label">Confirm Password</label>

                        <div class="col-sm-8">
                          <input type="password" name="conf_new_password" class="form-control" id="inputPassword3" placeholder="Confirm Password">
                          <span class="text-danger">{{ $errors->first('conf_new_password') }}</span>
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
      <!-- /.example-modal -->

      <!-- Change password Confirm Modal -->
      <div class="example-modal">
        <div class="modal modal-success fade" id="successModal">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                
              </div>
              <div class="modal-body">
              <p>Your admn password has changed successful. Use new password from next login.</p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>                
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
      </div>

      <!-- Change password Failed Modal -->
      <div class="example-modal">
        <div class="modal modal-danger fade" id="failedModal">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                
              </div>
              <div class="modal-body">
              <p>Password changed request failed. Please try again.</p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>                
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
      </div>

      