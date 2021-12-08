@if(count($data['response']) > 0)
    @foreach($data['response'] as $product)
        <div class="col-2 p-3 border border-warning">
            <a href="{{ route('createItem',$product['id']) }}">
                <img class="img-fluid img rounded mx-auto d-block" src="{{ getProductImage($product['image']['src']) }}" alt="">
                <h3 class=" text-center text-dark">{{ $product['title'] }}</h3>
                <h5 class="text-center text-dark"> <span class="text-success text-bold">{{ count($product['variants']) }}</span> Variants</h5>
            </a>
        </div>
    @endforeach
@elseif(request()->ajax())
    <div class="col-4 p-3 mx-auto border border-warning">
        <a href="#">
            <h3 class=" text-center text-dark">No Search Result</h3>
        </a>
    </div>
@else
    <div class="col-4 p-3 mx-auto border border-warning">
        <a href="#">
            <h3 class=" text-center text-dark">No Record Found</h3>
        </a>
    </div>
@endif
