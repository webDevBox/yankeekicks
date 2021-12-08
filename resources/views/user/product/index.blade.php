@extends('layouts.user')
@section('styles')

@endsection

@section('content')
<div class="col-4 offset-4">
    <input type="text" class="form-control searcher search_style" placeholder="Search Here..">
</div>


<div class="row finder mt-3">
    @include('partials._show_products')
</div>

@section('script')
<script>

$(".searcher").keyup(function(){

    var input = $(".searcher").val();
    let data = {title:input};
    let url = "{{route('productList')}}";
    let loader = "<img class='center offset-5 mt-3' src='{{asset('loader.gif')}}'>";
    $('.finder').html(loader);
    $.get(url,data,function (response){
        $('.finder').html(loader);
        $('.finder').html(response);
    })
    });
</script>
    
@endsection

@endsection