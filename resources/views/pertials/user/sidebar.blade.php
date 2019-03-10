<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="text-center image">
                @if(Session::has('user_image'))
                    <img src="{{url('assets/images/user/'.Session::get('user_image'))}}" class="img-circle" alt="User Image">
                @else
                    <img src="{{url('assets/images/user/demo.jpg')}}" class="img-circle" alt="User Image">
                @endif    
            </div>
            <div class="pull-left info">
                <p style="margin-top:10px">
                    {{ Auth::user()->name }}
                </p>
            </div>
        </div>

        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <li class="treeview" id='home'>
                <a href="{{url('/home')}}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
            </li>

            
            <li class="treeview" id='url-management'>
                <a href="javascript:;">    
                    <i class="fa fa-link" aria-hidden="true"></i>
                    <span>URL Management</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    @if(getCurrentUrl() === 'my-url')
                    <li class="active"><a href="{{url('/my-url')}}"><i class="fa fa-circle-o"></i> My Request</a></li>   
                    @else
                    <li><a href="{{url('/my-url')}}"><i class="fa fa-circle-o"></i> My Request</a></li>
                    @endif   
                    @hasanyrole('super admin|admin')
                    <li class="active"><a href="{{url('/pending-reqests')}}"><i class="fa fa-circle-o"></i> Unverified Requests</a></li>  
                    @endhasanyrole
                    @hasanyrole('super admin|admin')
                    <li class="active"><a href="{{url('/all-url-list')}}"><i class="fa fa-circle-o"></i> All Requests</a></li>           
                    @endhasanyrole
                </ul>
            </li>  
            
            @hasanyrole('super admin|admin')
            <li class="treeview" id='user-management'>
                <a href="javascript:;">    
                    <i class="fa fa-users" aria-hidden="true"></i>
                    <span>User Management</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    @hasanyrole('super admin|admin')
                    <li class="active"><a href="{{url('/user-management')}}"><i class="fa fa-circle-o"></i>User Manage</a></li>
                    @endhasanyrole

                    @hasanyrole('super admin|admin')
                    <li class="active"><a href="{{url('/user-list-view')}}"><i class="fa fa-circle-o"></i> All User</a></li>  
                    @endhasanyrole
                    
                </ul>
            </li>
            @endhasanyrole

        </ul>
        <br />
    </section>
    <!-- /.sidebar -->
</aside>