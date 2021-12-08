<!-- ========== Left Sidebar Start ========== -->
<div class="left side-menu">

    <div class="slimscroll-menu" id="remove-scroll">
        <!-- Logo -->
        <div class="user-box">
            <div class="user-img">
               <a href="{{ route('adminDashboard.index') }}"><img src="{{ asset('files/images/theme/logo.png') }}" width="120" alt="Yankeekicks Logo" title="Yankeekicks"></a> 
            </div>
        </div>

        <hr>

        <!--- Sidemenu -->
        <div id="sidebar-menu">

            <ul class="metismenu" id="side-menu">

                <!--<li class="menu-title">Navigation</li>-->

                <li>
                    <a href="{{ route('adminDashboard.index') }}">
                        <i class="fi-air-play"></i> <span> Dashboard </span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('manageUsers') }}">
                        <i class="fa fa-user"></i> <span> Manage Users </span>
                    </a>
                </li>
                
                <li>
                    <a href="{{ route('adminProducts') }}">
                        <i class="fa fa-suitcase"></i> <span> Products </span>
                    </a>
                </li>

                <li>
                    <a href="javascript: void(0);"><i class="fa fa-bank"></i> <span> Payments </span> <span class="menu-arrow"></span></a>
                    <ul class="nav-second-level" aria-expanded="false">
                        <li><a href="{{ route('adminPayment') }}"> <i class="fas fa-flag-checkered"></i> <span> Pending Payments </span> </a></li>
                        <li><a href="{{ route('paidPayments') }}"><i class="fa fa-money"></i> <span> Paid Payments </span></a></li>
                    </ul>
                </li>
                
                <li>
                    <a href="{{ route('seller') }}">
                        <i class="fa fa-shopping-basket"></i> <span> Consignments </span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('tickets') }}">
                        <i class="fa fa-ticket"></i> <span> Contact Tickets </span>
                    </a>
                </li>
                
            </ul>

        </div>
        <!-- Sidebar -->

        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->

</div>
<!-- Left Sidebar End -->