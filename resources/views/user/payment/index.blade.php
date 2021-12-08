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
                        <div class="pull-left"><h4 class="text-orange">Your Transactions</h4></div>
                       <div class="clearfix"></div>
                   </div>
                    <p class="text-muted font-14 m-b-30">
                    </p>
                        <table id="datatable" class="table table-bordered table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead class="thead-light">
                            <tr>
                                <th>No</th>
                                <th>Type</th>
                                <th>Amount</th>
                                <th>Transaction Date</th>
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


@section('script')
<script type="text/javascript">
    $(function () {
      
      var table = $('#datatable').DataTable({
          processing: true,
          "language": {
            processing: '<i class="fas fa-spinner fa-pulse fa-2x fa-fw"></i>'},
          serverSide: true,
          ajax: "{{ route('userPayment') }}",
          columns: [
              {data:'DT_RowIndex', name: 'DT_RowIndex'},
              {data: 'type', name: 'type', orderable: false},
              {data: 'amount', name: 'amount', orderable: true},
              {data: 'date', name: 'date', orderable: false},
          ]
      });
      
    });
  </script>
@endsection

@endsection