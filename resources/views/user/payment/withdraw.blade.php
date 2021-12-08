@extends('layouts.user')
@section('styles')

@endsection

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card-box">
                    <div class="header-title mb-4 col-12">
                        <div class="pull-left"><h4 class="text-orange">Withdraw</h4></div>
                       <div class="clearfix"></div>
                   </div>
                    <p class="text-muted font-14 m-b-30">
                        You can withdraw amount from your wallet
                    </p>

                        <div class="row">
                            <div class="col-9 offset-3">
                                <div class="row">
                                    <h1 class="col-3">From</h1>
                                    <div class="shadow-lg rounded box1 row p-5 boxer">
                                        <h1 class="col-2 text-info"><i class="fas fa-wallet"></i></h1>
                                        <h3 class="col-4 justify">Yankeekicks Wallet</h3>
                                        <h2 class="text-success offset-2 col-4">${{ user()->amount }}</h2>
                                    </div>
                                </div>
                            </div>
                            <div class="col-9 offset-3 mt-3">
                                <div class="row">
                                    <h1 class="col-3">To</h1>
                                    <div class="border border-dark box2 row p-5 boxer">
                                        <h1 class="col-2 text-info"><i class="fas fa-university"></i></h1>
                                        <h3 class="col-10">Bank Account</h3>
                                        <h4 class="text-dark offset-2 col-10">5445135154435154453</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-9 offset-3 mt-3">
                                <div class="row">
                                    <h1 class="col-3">Amount</h1>
                                    <div class="border border-dark box3 row p-5 boxer">
                                        <form action="{{ route('withdrawAmount') }}" method="post">
                                            @csrf
                                            <div class="form-group">
                                                <input type="number" min="0" max="{{ user()->amount }}" name="amount" class="form-control boxer_input" placeholder="Enter your withdrawal amount">
                                                <small id="error-message" class="d-none text-danger">You have only ${{ user()->amount }} in your wallet</small>
                                            </div>
                                            <div class="row">
                                                <button type="reset" class="col-3 offset-3 btn btn-danger"> Cancle </button>
                                                <button type="submit" class="col-3 offset-1 btn btn-success rounded"> Continue </button>
                                            </div>
                                            
                                        </form>
                                    </div>
                                </div>
                            </div>

                        </div>

                </div>
            </div>
        </div> <!-- end row -->

    </div> <!-- container -->

</div> <!-- content -->

@section('script')
<script>
    $(".boxer_input").keyup(function(){
        var input = $(".boxer_input").val();
        var limit = {{ user()->amount }}
        if(input < 0)
        {
            $(".boxer_input").val(0);
        }
        if(input > limit)
        {
            $(".boxer_input").val(limit);
            $(".boxer_input").attr('class','form-control boxer_input border border-danger');
            $('#error-message').removeClass('d-none');
        }
        else{
            $(".boxer_input").attr('class','form-control boxer_input');
            $('#error-message').addClass('d-none');
        }
    });
</script>

<script>
    $('.box1').mouseenter(function(){
        $('.box1').attr('class','shadow-lg rounded box1 row p-5 boxer');
        $('.box2').attr('class','border border-dark box2 row p-5 boxer');
        $('.box3').attr('class','border border-dark box3 row p-5 boxer');
    });
    $('.box2').mouseenter(function(){
        $('.box2').attr('class','shadow-lg rounded box2 row p-5 boxer');
        $('.box1').attr('class','border border-dark box1 row p-5 boxer');
        $('.box3').attr('class','border border-dark box3 row p-5 boxer');
    });
    $('.box3').mouseenter(function(){
        $('.box3').attr('class','shadow-lg rounded box3 row p-5 boxer');
        $('.box1').attr('class','border border-dark box1 row p-5 boxer');
        $('.box2').attr('class','border border-dark box2 row p-5 boxer');
    });
</script>
@endsection

@endsection