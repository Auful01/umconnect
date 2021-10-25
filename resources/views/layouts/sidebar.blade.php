<aside class="main-sidebar sidebar-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{url('/')}}" class="brand-link">
      <img src="{{asset('images/umlogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-2">
      <span class="brand-text" style="font-weight: 600">UMConnect</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{asset('images/umlogo.png')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="{{url('/')}}" class="d-block">@if (Auth::check())
            {{Auth::user()->name}}
            @else
            Guest
          @endif</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      {{-- <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div> --}}

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <li class="nav-item ">
                <a href="{{url('/')}}" class="nav-link {{ Request::segment(1) == '' ? 'active' : ''}}">
                  <i class="fas fa-tachometer-alt nav-icon"></i>
                  <p>Dashboard</p>
                </a>
              </li>
            <li class="nav-item">
                <a href="{{route('kiriman.index')}}" class="nav-link {{ Request::segment(1) == 'kiriman' ? 'active' : ''}}">
                  <i class="fas fa-comment-alt nav-icon"></i>
                  <p>Kiriman</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('user.index')}}" class="nav-link {{ Request::segment(1) == 'user' ? 'active' : ''}}">
                  <i class="fas fa-user nav-icon"></i>
                  <p>User</p>
                </a>
              </li>
            <li class="nav-item">
                <a href="{{route('layananWeb.index')}}" class="nav-link {{ Request::segment(1) == 'layananWeb' ? 'active' : ''}}">
                  <i class="fas fa-list nav-icon"></i>
                  <p>Layanan</p>
                </a>
              </li>
            <li class="nav-item">
                <a href="{{route('agendaWeb.index')}}" class="nav-link {{ Request::segment(1) == 'agendaWeb' ? 'active' : ''}}">
                  <i class="fas fa-calendar-alt nav-icon"></i>
                  <p>Agenda</p>
                </a>
              </li>

            <li class="nav-item">
                <a href="{{route('produkWeb.index')}}" class="nav-link {{ Request::segment(1) == 'produkWeb' ? 'active' : ''}}">
                  <i class="fas fa-box-open nav-icon"></i>
                  <p>Produk</p>
                </a>
            </li>
            @if (Auth::check())
            <li class="nav-item">
                <a href="{{route('logout')}}" class="nav-link" onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
                  <i class="fas fa-power-off nav-icon"></i>
                  <p>Logout</p>
                </a>

                <form action="{{route('logout')}}" id="logout-form" method="POST">
                    @csrf
                </form>
              </li>
            @endif


        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
