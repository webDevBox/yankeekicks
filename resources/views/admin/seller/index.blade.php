@extends('layouts.admin')
@section('styles')
<link rel="stylesheet" href="{{ asset('theme/plugins/switchery/switchery.min.css') }}" />
@endsection

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card-box">
                    <div class="header-title mb-4 col-12">
                        <div class="pull-left"><h4 class="text-orange">Users List</h4></div>
                       <div class="clearfix"></div>
                   </div>
                    <p class="text-muted font-14 m-b-30">
                    </p>
                    <div class="finder d-none"><img class='center offset-5 mt-3' src='{{asset('loader.gif')}}'></div>
                        <table id="datatable" class="table table-bordered table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead class="thead-light">
                            <tr>
                                <th>No</th>
                                <th>Seller Name</th>
                                <th>Product Name</th>
                                <th>Shipping Number</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                </div>
            </div>
        </div> <!-- end row -->

    </div> <!-- container -->

</div> <!-- content -->


@section('scripts')
<script type="text/javascript">
    $(function () {
      
      var table = $('#datatable').DataTable({
          processing: true,
          "language": {
            processing: '<i class="fas fa-spinner fa-pulse fa-2x fa-fw"></i>'},
          serverSide: true,
          ajax: "{{ route('seller') }}",
          columns: [
              {data:'DT_RowIndex', name: 'DT_RowIndex'},
              {data: 'seller', name: 'seller', orderable: false},
              {data: 'product', name: 'product', orderable: false},
              {data: 'shipping', name: 'shipping', orderable: false},
              {data: 'status', name: 'status', orderable: false},
              {data: 'action', name: 'action', orderable: false, searchable: false},
          ]
      });
      
    });
  </script>

<script>
    function changer(id)
    {
        var value = 0;
        var note = "null";
        var status = $('.clock_'+id).find(":selected").text();
        if(status == 'Approved') value=1;
        if(status == 'Rejected')
        {
            while(note == "null" || note == "")
            {
                note = prompt("Write note for seller");
            }
            if(note == null)
            {
                $('.clicker_'+id).val(0);
                return false;
            }
            value=2;
        }
    if (confirm('Are you sure to change status?'))
      {
        $('.finder').removeClass('d-none');
        $('#datatable').addClass('d-none');
        var app = {!! json_encode(url('/')) !!}
        var url = app+'/admin/seller/productStatus/'+id+"/"+value+"/"+note;
        $.ajax({
        type: "GET",
        dataType: "json",
        url: url,
        data: {'id': id},
        success: function(data){
            $('#datatable').removeClass('d-none');
            $('.finder').addClass('d-none');
            if(status == 'Approved')
                $('.clock_'+id).html("<label class='badge badge-info'>Approved</label>")
            if(status == 'Rejected')
                $('.clock_'+id).html("<label class='badge badge-danger'>Rejected</label>")
            }
        });
      }
      else{
        $('.clicker_'+id).val(0);
          return false;
      }
    }
</script>

<script>
    function myFunction(id)
    {
      if (confirm('Are you sure to delete product?'))
      {
          var url = '{{ route("userProductDelete", ":id") }}';
          url = url.replace(':id', id);
          window.location.href = url;
      }
      else{
          return false;
      }
    }
</script>


@endsection

@endsection