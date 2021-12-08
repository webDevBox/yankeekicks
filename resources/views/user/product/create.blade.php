@extends('layouts.user')
@section('styles')

@endsection

@section('content')

<div class="row">
    <div class="col-7 bg-white">
        <h1 class="text-center">{{ $product['response']['title'] }}</h1>
        <img src="{{ getProductImage($product['response']['image']['src']) }}" class="img-large main mx-auto d-block img-fluid rounded" alt="">
        <div class="row p-2">
            @foreach ($product['response']['images'] as $image)
            <div class="mx-auto col-1 mt-2">
                <img src="{{ getProductImage($image['src']) }}" class="img-selecter pointer img-small  img-fluid rounded">
            </div>
            @endforeach
        </div>
    </div>

    {{-- Add Item Section --}}
    <div class="col-5 p-5 bg-light mx-auto">
        <form action="{{ route('storeItem') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="first_step">
                <input type="hidden" value="{{ $product['response']['id'] }}" name="product_id" required>
                <input type="hidden" class="size" value="{{ old('size') }}" name="size" required>
                <h2> Select Size </h2>
                <div class="row">
                    @foreach($product['response']['variants'] as $variant)
                        <div class="col-2 pointer @if(old('size') == $variant['title']) bg-success @else bg-white @endif border border-dark m-1 p-2 sizer" data-sku="{{ $variant['sku'] }}" id="{{ $variant['title'] }}">
                            <h3 class="text-center">{{ $variant['title'] }}</h3>
                            <p class="text-center">{{ $variant['sku'] }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="second_step d-none">
                <div class="row">
                    <div class="col-4 pointer bg-white border border-dark m-1 p-2">
                        <h3 class="text-center back"><i class="fa fa-arrow-left" aria-hidden="true"></i> <p>Change Variant</p>  </h3>
                    </div>

                    <div class="col-2 pointer bg-success border border-dark m-1 p-2">
                        <h3 class="text-center second_variant"></h3>
                        <p class="text-center second_sku"></p>
                    </div>
                </div>
                
                <div class="form-group">
                    <label>Enter Price</label>
                    <input type="number" min="1" value="{{ old('price') }}" name="price" class="form-control pricer" placeholder="Enter Price" required>
                    <small id="error-message1" class="d-none text-danger">Price must be greater than 0</small>
                </div>
                <div class="form-group">
                    <label>Enter Quantity</label>
                    <input type="number" min="1" value="{{ old('quantity') }}" name="quantity" class="form-control quanter" placeholder="Enter Quantity" required>
                    <small id="error-message2" class="d-none text-danger">Quantity must be greater than 0</small>
                </div>
                
                <div class="form-group">
                    <label>Select Condition</label>
                    <select name="condition" id="" class="form-control" required>
                        <option disabled selected>Select Shoe Condition</option>
                        <option value="0">New with Shoe Box</option>
                        <option value="1">New without Shoe Box</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label>Select Delivery Method</label><br>
                    Shippment: <input type="radio" value="shippment" class="mr-5" name="delivery" required>
                    Drop-off: <input type="radio" value="dropOff"  name="delivery" required>
                </div>
                
                <div class="form-group">
                    <label>Add Images</label>
                    
                </div>
                <input type="file" id="images" class="d-none imager" accept="image/*" maxlength="6" name="images[]" multiple="true" />
                <div id="collection" class="row box border border-warning pointer image_selector">
                    <h1 class="mx-auto my-auto"> Select Images </h1>
                </div>
                <div class="row">
                    <div class="preview-0"></div>
                    <div class="preview-1"></div>
                    <div class="preview-2"></div>
                    <div class="preview-3"></div>
                    <div class="preview-4"></div>
                    <div class="preview-5"></div>
                </div>
                <button type="submit" class="btn btn-primary my-2 d-block mx-auto">Add Item</button>
            </div>
        </form>
    </div>
</div>

@section('script')
<script>
    $(".pricer").keyup(function(){
        var input = $(".pricer").val();
        if(input < 0)
        {
            $(".pricer").val(1);
            $(".pricer").attr('class','form-control pricer border border-danger');
            $('#error-message1').removeClass('d-none');
        }
        else{
            $(".pricer").attr('class','form-control pricer');
            $('#error-message1').addClass('d-none');
        }
    });
    
    $(".quanter").keyup(function(){
        var quantity = $(".quanter").val();
        if(quantity < 0)
        {
            $(".quanter").val(1);
            $(".quanter").attr('class','form-control quanter border border-danger');
            $('#error-message2').removeClass('d-none');
        }
        else{
            $(".quanter").attr('class','form-control quanter');
            $('#error-message2').addClass('d-none');
        }
    });
</script>


<script>
    $('.image_selector').click(function(){
        $('.imager').click();
    });
</script>

    <script>
        var number = 0;
$('#images').on('change', function(){
    var filelists = this.files || [];        
    $.each(filelists, function(i, filelist){
        var reader = new FileReader();

        reader.onload = function (e) {
            $( '.preview-' + number ).html('<img class="image-preview mx-1" src="'+ e.target.result +'" width=50 height=50 />'); 
            number ++ ;
            
        }
        reader.readAsDataURL(filelist);
    });  
    $('#collection').attr('style','display:none;');
});
    </script>
    <script>
        $('.img-selecter').click(function(){
            var src = $(this).attr('src');
            
            $('.main').attr('src',src);
        });
    </script>

    <script>
        $('.sizer').click(function(){
            $('.sizer').removeClass('bg-success');
            $('.sizer').addClass('bg-white');
            let size = $(this).attr('id');
            let variant = $(this).data('sku');
            $(this).removeClass('bg-white');
            $(this).addClass('bg-success');
            $('.size').val(size);
            
            $('.second_variant').text(size);
            $('.second_sku').text(variant);
            
            $('.first_step').attr('class','first_step d-none');
            $('.second_step').attr('class','second_step');

        });

        $('.back').click(function(){
            $('.first_step').attr('class','first_step');
            $('.second_step').attr('class','second_step d-none');
        });
       
    </script>

@endsection

@endsection