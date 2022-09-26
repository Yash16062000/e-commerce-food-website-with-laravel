<div class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left" id="cbp-spmenu-s1">
		<!--left-fixed -navigation-->
		<aside class="sidebar-left">
      <nav class="navbar navbar-inverse">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".collapse" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            </button>
            @php 
              $role = Helper::adminType(Auth::user()->id);
              if(!empty($role)){
            @endphp
            <h1><a class="navbar-brand" href="backend.dashboard.index"><span class="fa fa-area-chart"></span> FoodChilli<span class="dashboard_text">{{$role->role_type}} dashboard</span></a></h1>
            @php
              }
            @endphp
          </div>
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="sidebar-menu">
              <li class="header">MAIN NAVIGATION</li>
              <li class="treeview">
                <a href="{{ route('dashboard') }}">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                </a>
              </li>
              @php 
              $navbars = Helper::menu();
              if(!empty($navbars) && Auth::user()->user_type!=1){
              @endphp
              @foreach ($navbars as $navbarItem)   
              @php
              $check = Helper::checkMenuPermission(Auth::user()->user_type,$navbarItem->id); 
              if(!empty($check)) {
              @endphp  
			        <li class="treeview">
                <a href="{{ route($navbarItem->route) }}">
                <i class="{{ $navbarItem->icon }}"></i>
                <span>{{ $navbarItem->menu }}</span>

                </a>
              </li>
              @php
              }
              @endphp
              @endforeach
              @php
              }else{
              @endphp

              @foreach ($navbars as $navbarItem)              
			        <li class="treeview">
                <a href="{{ route($navbarItem->route) }}">
                <i class="{{ $navbarItem->icon }}"></i>
                <span>{{ $navbarItem->menu }}</span>

                </a>
              </li>
              @endforeach

              @php
              }
              @endphp
              <li><a href="{{ route('logout_admin') }}"><i class="fa fa-sign-out text-aqua"></i> <span>Logout</span></a></li>
            </ul>
          </div>
          <!-- /.navbar-collapse -->
      </nav>
    </aside>
	</div>