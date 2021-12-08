@extends('layouts.user')

@section('breadcrumb')
<li>
    <a href="#"><span style="text-transform:capitalize ">Dashboard</span></a>
</li>
@endsection

@section('content')
   <!-- Start Page content -->
<div class="content">
    <div class="container-fluid">
        
        <div class="row">
            <div class="col-sm-6 col-xl-3">
                <div class="card-box widget-chart-two">
                    <div class="float-right">
                        <div class="mt-4 text-success h3"><i class="fa fa-usd" aria-hidden="true"></i></div>
                    </div>
                    <div class="widget-chart-two-content">
                        <p class="text-muted mb-0 mt-2">Wallet</p>
                        <h2 class="text-success" data-plugin="counterup"> {{ user()->amount }} </h2>
                    </div>

                </div>
            </div>

            <div class="col-sm-6 col-xl-3">
                <div class="card-box widget-chart-two">
                    <div class="float-right">
                        <div class="mt-4 text-info h3"><i class="fas fa-exchange-alt" aria-hidden="true"></i></div>
                    </div>
                    <div class="widget-chart-two-content">
                        <p class="text-muted mb-0 mt-2">Total Earning</p>
                        <h2 class="text-info" data-plugin="counterup">{{ $earning }}</h2>
                    </div>

                </div>
            </div>

            <div class="col-sm-6 col-xl-3">
                <div class="card-box widget-chart-two">
                    <div class="float-right">
                        <div class="mt-4 text-warning h3"><i class="fa fa-product-hunt" aria-hidden="true"></i></div>
                    </div>
                    <div class="widget-chart-two-content">
                        <p class="text-muted mb-0 mt-2">Consignment</p>
                        <h2 class="text-warning" data-plugin="counterup">{{ $consignment }} </h2>
                    </div>

                </div>
            </div>

            <div class="col-sm-6 col-xl-3">
                <div class="card-box widget-chart-two">
                    <div class="float-right">
                        <div class="mt-4 text-danger h3"><i class="fa fa-ticket" aria-hidden="true"></i></div>
                    </div>
                    <div class="widget-chart-two-content">
                        <p class="text-muted mb-0 mt-2">Pending Tickets</p>
                        <h2 class="text-danger" data-plugin="counterup">{{ $pendingTicket }}</h2>
                    </div>

                </div>
            </div>
        </div>
        <!-- end row -->

    </div> <!-- container -->

</div> <!-- content -->

@endsection

@section('scripts')
<script>
    $('.carousel').carousel({
  interval: 5000
});
</script>

@endsection

@section('script')
    
@endsection