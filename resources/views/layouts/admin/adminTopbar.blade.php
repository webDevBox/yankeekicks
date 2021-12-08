<!-- Top Bar Start -->
<div class="topbar">

    <nav class="navbar-custom">

        <ul class="list-unstyled topbar-right-menu float-right mb-0">

            <li class="dropdown notification-list">
                <a class="nav-link dropdown-toggle nav-user" data-toggle="dropdown" href="#" role="button"
                   aria-haspopup="false" aria-expanded="false">
                    <img @if(user()->image != null) src="{{ asset(userImage()) }}" @else src="{{ asset('files/images/theme/logo.png') }}" @endif alt="user" class="rounded-circle"> <span class="ml-1">{{ user()->name }}  <i class="mdi mdi-chevron-down"></i> </span>
                </a>
                <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated profile-dropdown">
                    <!-- item-->
                    <div class="dropdown-item noti-title">
                        <h6 class="text-overflow m-0">Welcome</h6>
                    </div>

                    <!-- item-->
                    <a href="{{ route('adminProfile') }}" class="dropdown-item notify-item">
                        <i class="fi-head"></i> <span>Profile</span>
                    </a>
                    
                    <!-- item-->
                    <a href="{{ route('adminLogout') }}" class="dropdown-item notify-item">
                        <i class="fi-power"></i> <span>Logout</span>
                    </a>

                </div>
            </li>

        </ul>
        <ul class="list-inline menu-left mb-0">
            <h4 class="page-title">Dashboard</h4>
            @if (Session::has('success'))
              <p class="shower alert {{ Session::get('alert-class', 'alert-success') }}">{{ Session::get('success') }}</p>
            @endif
            @if (Session::has('error'))
              <p class="shower alert {{ Session::get('alert-class', 'alert-danger') }}">{{ Session::get('error') }}</p>
            @endif
            <ol class="breadcrumb">
                    @yield('breadcrumb')
            </ol>
        </ul>
    </nav>

</div>
<!-- Top Bar End -->