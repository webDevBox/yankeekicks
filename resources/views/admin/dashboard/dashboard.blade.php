@extends('layouts.admin')


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
                        <div class="mt-4 text-success h3"><i class="fa fa-user" aria-hidden="true"></i></div>
                    </div>
                    <div class="widget-chart-two-content">
                        <p class="text-muted mb-0 mt-2">Users</p>
                        <h2 class="" data-plugin="counterup"> {{ count($users) }} </h2>
                    </div>

                </div>
            </div>

            <div class="col-sm-6 col-xl-3">
                <div class="card-box widget-chart-two">
                    <div class="float-right">
                        <div class="mt-4 text-warning h3"><i class="fa fa-shopping-bag" aria-hidden="true"></i></div>
                    </div>
                    <div class="widget-chart-two-content">
                        <p class="text-muted mb-0 mt-2">Sellers</p>
                        <h2 class="" data-plugin="counterup">{{ count($sellers) }} </h2>
                    </div>

                </div>
            </div>

            <div class="col-sm-6 col-xl-3">
                <div class="card-box widget-chart-two">
                    <div class="float-right">
                        <div class="mt-4 text-danger h3"><i class="fa fa-suitcase" aria-hidden="true"></i></div>
                    </div>
                    <div class="widget-chart-two-content">
                        <p class="text-muted mb-0 mt-2">Products</p>
                        <h2 class="" data-plugin="counterup">{{ count($products) }} </h2>
                    </div>

                </div>
            </div>

            <div class="col-sm-6 col-xl-3">
                <div class="card-box widget-chart-two">
                    <div class="float-right">
                        <div class="mt-4 text-info h3"><i class="fa fa-ticket" aria-hidden="true"></i></div>
                    </div>
                    <div class="widget-chart-two-content">
                        <p class="text-muted mb-0 mt-2">Contact Tickets</p>
                        <h2 class="" data-plugin="counterup">{{ count($contacts) }}</h2>
                    </div>

                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-lg-6 ">
                <div class="card-box">
                    <div class="text-uppercase mb-4">
                        <div class="pull-left"><h4 class="text-orange">Recent Added Sellers</h4></div>
                        
                        {{-- view all --}}
                            <div class="pull-right"><a href="{{ route('manageUsers') }}" class="btn btn-rounded btn-sm btn-success">View All</a></div>
                        
                        <div class="clearfix"></div>
                    </div>
                    
                    <div class="inbox-widget slimscroll" style="max-height: 370px;">
                        @forelse($recentUsers as $recentUser)
                            <a href="#">
                                <div class="inbox-item">
                                    <div class="inbox-item-img"><img @if($recentUser->image == null) src="{{ asset(dummyImage()) }}" @else src="{{ asset(userImageByObject($recentUser->image)) }}" @endif class="rounded-circle" height="40" width="40" alt=""></div>
                                    <p class="inbox-item-author">{{ $recentUser->name }}</p>
                                    <p class="inbox-item-author text-muted ">{{ count($recentUser->products) }} Products</p>
                                    <div class=" badge badge-pill badge-success inbox-item-date text-white text-uppercase mt-2">${{ $recentUser->amount }} Amount</div>
                                </div>
                            </a> 
                        @empty
                            <div align="center" class="mt-5">
                                <img class="" src="{{ asset('theme/assets/images/no data.png') }}" height="100" width="100" alt="">
                                <div class="text-muted">No recent Seller.</div>
                            </div>
                        @endforelse
                    </div>

                </div>
            </div>
            <div class="col-lg-6 ">
                <div class="card-box">
                    <div class="text-uppercase mb-4">
                        <div class="pull-left"><h4 class="text-orange">Recent Added Products</h4></div>
                        
                        {{-- view all --}}
                            <div class="pull-right"><a href="{{ route('adminProducts') }}" class="btn btn-rounded btn-sm btn-success">View All</a></div>
                        
                        <div class="clearfix"></div>
                    </div>
                    
                    <div class="inbox-widget slimscroll" style="max-height: 370px;">
                        @forelse($recentProducts as $product)
                            <a href="#">
                                <div class="inbox-item">
                                    <div class="inbox-item-img"><img src="{{ asset(userImageByObject($product->user->image)) }}" class="rounded-circle" height="40" width="40" alt=""></div>
                                    <p class="inbox-item-author">{{ $product->product_id['response']['title'] }} </p>
                                    <p class="inbox-item-author text-muted ">{{ $product->quantity }} Quantity</p>
                                    <div class="badge badge-pill badge-success inbox-item-date text-white text-uppercase">${{ $product->price }} Price</div>
                                    <div class="mt-4 badge badge-pill badge-info inbox-item-date text-white text-uppercase">{{ $product->size }} Variant</div>
                                </div>
                            </a> 
                        @empty
                            <div align="center" class="mt-5">
                                <img class="" src="{{ asset('theme/assets/images/no data.png') }}" height="100" width="100" alt="">
                                <div class="text-muted">No recent Products.</div>
                            </div>
                        @endforelse
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