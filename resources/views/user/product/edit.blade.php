@extends('layouts.user')
@section('styles')

@endsection

@section('content')

<div class="row">
    <div class="col-7 bg-white">
        <h1 class="text-center">{{ $product['response']['title'] }}</h1>
        <img src="{{ getProductImage($product['response']['image']['src']) }}" class="img-large main mx-auto d-block img-fluid rounded" alt="">
        <div class="row p-2 mx-auto">
            @foreach ($product['response']['images'] as $image)
            <div class="mx-auto col-1 mt-2">
                <img src="{{ getProductImage($image['src']) }}" class="img-selecter pointer img-small  img-fluid rounded">
            </div>
            @endforeach
        </div>
    </div>

    {{-- Update Item Section --}}
    <div class="col-5 p-5 bg-light mx-auto">
        <form action="{{ route('updateItem') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="first_step">
                <input type="hidden" value="{{ $myProduct->id }}" name="id" required>
                <input type="hidden" class="size" value="{{ $myProduct->size }}" name="size" required>
                <h2> Select Size </h2>
                <div class="row">
                    @foreach($product['response']['variants'] as $variant)
                        <div class="col-2 pointer @if($myProduct->size == $variant['title']) bg-success @endif border border-dark mx-1 p-2 sizer" id="{{ $variant['title'] }}">
                            <h3 class="text-center">{{ $variant['title'] }}</h3>
                            <p class="text-center">{{ $variant['sku'] }}</p>
                        </div>
                    @endforeach
                </div>
                {{-- <button type="button" class="pull-right btn btn-primary next">Next <i class="fa fa-arrow-right" aria-hidden="true"></i></button> --}}
            </div>
            <div class="second_step d-none">
                <div class="form-group">
                    <label>Enter Price</label>
                    <input type="number" min="1" name="price" class="form-control pricer" value="{{ $myProduct->price }}" required>
                    <small id="error-message1" class="d-none text-danger">Price must be greater than 0</small>
                </div>
                <div class="form-group">
                    <label>Enter Quantity</label>
                    <input type="number" min="1" name="quantity" class="form-control quanter" value="{{ $myProduct->quantity }}" required>
                    <small id="error-message2" class="d-none text-danger">Quantity must be greater than 0</small>
                </div>
                
                <div class="form-group">
                    <label>Select Condition</label>
                    <select name="condition" id="" class="form-control" required>
                        <option @if($myProduct->condition == 'New with Shoe Box') selected @endif value="0">New with Shoe Box</option>
                        <option @if($myProduct->condition == 'New without Shoe Box') selected @endif value="1">New without Shoe Box</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label>Select Delivery Method</label><br>
                    Shippment: <input type="radio" value="shippment" @if($myProduct->delivery == 'shippment') checked @endif class="mr-5" name="delivery" required>
                    Drop-off: <input type="radio" value="dropOff" @if($myProduct->delivery == 'dropOff') checked @endif  name="delivery" required>
                </div>
                
                <div class="form-group">
                    <label>Images</label>
                    
                </div>
                <input type="file" id="images" class="d-none imager" accept="image/*" maxlength="6" name="images[]" multiple="true" />
                <div id="collection" class="border border-warning">
                    <h1 class="text-center"> Your Images </h1>
                    <div class="row">
                        @foreach ($myProduct->productImages as $image)
                        <div class="col-3">
                            <img src="{{ asset('files/'.$image->image) }}" class="img-box" alt="">
                        </div>
                        @endforeach
                    </div>
                    <button type="button" class="btn btn-success pointer image_selector my-2 d-block mx-auto">Change Image</button>

                </div>
                
                <div class="row">
                    <div class="preview-0"></div>
                    <div class="preview-1"></div>
                    <div class="preview-2"></div>
                    <div class="preview-3"></div>
                    <div class="preview-4"></div>
                    <div class="preview-5"></div>
                </div>
                <button type="submit" class="btn btn-primary my-2 d-block mx-auto">Update Item</button>
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
            let size = $(this).attr('id');
            $('.size').val(size);
            

            $('.first_step').attr('class','first_step d-none');
            $('.second_step').attr('class','second_step');

        });
        // $('.next').click(function(){
        //     $('.first_step').attr('class','first_step d-none');
        //     $('.second_step').attr('class','second_step');

        // });
       
    </script>

@endsection

@endsection