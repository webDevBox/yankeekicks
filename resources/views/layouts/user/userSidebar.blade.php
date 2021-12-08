<!-- ========== Left Sidebar Start ========== -->
<div class="left side-menu">

    <div class="slimscroll-menu" id="remove-scroll">
        <!-- Logo -->
        <div class="user-box">
            <div class="user-img">
               <a href="{{ route('userDashboard.index') }}"><img src="{{ asset('files/images/theme/logo.png') }}" width="120" alt="Yankeekicks Logo" title="Yankeekicks"></a> 
            </div>
        </div>

        <hr>

        <!--- Sidemenu -->
        <div id="sidebar-menu">

            <ul class="metismenu" id="side-menu">

                <!--<li class="menu-title">Navigation</li>-->

                <li>
                    <a href="{{ route('userDashboard.index') }}">
                        <i class="fi-air-play"></i> <span> Dashboard </span>
                    </a>
                </li>

                <li>
                    <a href="javascript: void(0);"><i class="fa fa-suitcase"></i> <span> Consignment </span> <span class="menu-arrow"></span></a>
                    <ul class="nav-second-level" aria-expanded="false">
                        <li><a href="{{ route('productList') }}"> <i class="fa fa-plus"></i> <span> Add Item </span> </a></li>
                        <li><a href="{{ route('listItem') }}"><i class="fa fa-window-maximize"></i> <span>View Items</span></a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);"><i class="fa fa-bank"></i> <span> Payments </span> <span class="menu-arrow"></span></a>
                    <ul class="nav-second-level" aria-expanded="false">
                        <li><a href="{{ route('userPayment') }}"> <i class="fas fa-exchange-alt"></i> <span> Transactions </span> </a></li>
                        <li><a href="{{ route('withdraw') }}"><i class="fa fa-money"></i> <span>Withdraw Cash</span></a></li>
                    </ul>
                </li>

                <li>
                    <a href="{{ route('userHelp') }}">
                        <i class="fa fa-volume-control-phone"></i> <span> Contact Support </span>
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