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
                        <h4 class="text-center">Shipping Information</h4>
                       <div class="clearfix"></div>
                       <div id="print" class="row">
                           <div class="col-12">
                                <img src="{{ asset('files/images/theme/logo.png') }}" class="mx-auto d-block" alt="">
                           </div>
                            <div class="offset-3 col-3 border-dark border-top  border-bottom">
                                <h3>From:{{ $product->user->name }}</h3> 
                                <h4>Address: <span class="h6">{{ $product->user->address }}</span></h4>
                                <h5>City:{{ $product->user->city }}</h5> 
                            </div>
                            <div class="col-3 border-dark border-top border-bottom vertical">
                                <h3>To:{{ config('app.name') }}</h3> 
                                <h4>Address:{{ $product->user->name }}</h4>
                                <h5>City:{{ $product->user->name }}</h5> 
                            </div>
                            <div class="offset-3 col-6 border-dark border-top border-bottom mt-3">
                                {{-- <center> <svg id="barcode2"></svg> </center> --}}
                                <center> <img src="data:image/png;base64,{{DNS1D::getBarcodePNG($product->shipment_label, 'C39')}}" height="60" width="180" class="d-block mt-2" alt="barcode" />
                                    <h5>{{ $product->shipment_label }}</h5>
                                </center>
                            </div>
                            
                            <div class="offset-3 col-6 border-dark border-top border-bottom mt-3 py-3">
                                <h4 class="text-center"> Product Info </h4>
                                <div class="row">
                                    <div class="col-4">
                                        <h5 class="text-center">Size: <span class="text-bold text-success">{{ $product->size }}</span></h5> 
                                    </div>
                                    <div class="col-4">
                                        <h5 class="text-center">Condition: <span class="text-bold text-success">{{ $product->condition }}</span></h5>
                                    </div>
                                    <div class="col-4">
                                        <h5 class="text-center">Quantity: <span class="text-bold text-success">{{ $product->quantity }}</span></h5> 
                                    </div>
                                </div>
                            </div>
                       </div>
                       <button onclick="Export()" class="btn btn-success pull-right"> Print Shipping Label </button>
                   </div>
                </div>
                <div class="card-box">
                    <div class="header-title mb-4 col-12">
                        <h4 class="text-center">Product Details</h4>
                       <div class="clearfix"></div>
                       <img src="{{ getProductImage($product->product_id['response']['image']['src']) }}" class="img mx-auto d-block" alt="">
                       <h3 class="text-center">{{ $product->product_id['response']['title'] }}</h3>
                       <p class="text-center">{{ $product->product_id['response']['body_html'] }}</p>
                   </div>
                </div>
                <div class="card-box">
                    <div class="header-title mb-4 col-12">
                        <h4 class="text-center">Your Images</h4>
                       <div class="clearfix"></div>
                       <center>
                            @foreach ($product->productImages as $image)
                                <img src="{{ asset('files/'.$image->image) }}" class="img-box" alt="">
                            @endforeach
                       </center>
                   </div>
                </div>
            </div>
        </div> <!-- end row -->

    </div> <!-- container -->

</div> <!-- content -->


@section('script')
<script>
    JsBarcode("#barcode2", "{{$product->shipment_label}}", {
        font: "cursive",
        fontSize: 30
    });
</script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.22/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
    <script type="text/javascript">
        function Export() {
            html2canvas(document.getElementById('print'), {
                onrendered: function (canvas) {
                    var data = canvas.toDataURL();
                    var docDefinition = {
                        content: [{
                            image: data,
                            width: 500
                        }]
                    };
                    pdfMake.createPdf(docDefinition).download("Shipping Label.pdf");
                }
            });
        }
    </script>
@endsection

@endsection