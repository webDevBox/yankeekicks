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
                        <div class="pull-right">
                            <a href="{{ route('userCreate') }}" class="btn btn-success">Add User</a>
                        </div>
                       <div class="clearfix"></div>
                   </div>
                    <p class="text-muted font-14 m-b-30">
                    </p>
                        <table id="datatable" class="tableDatatable table table-bordered table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead class="thead-light">
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Address</th>
                                <th>City</th>
                                <th>Amount</th>
                                <th>Role</th>
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
      
      var table = $('.tableDatatable').DataTable({
          processing: true,
          "language": {
            processing: '<i class="fas fa-spinner fa-pulse fa-2x fa-fw"></i>'},
          serverSide: true,
          ajax: "{{ route('manageUsers') }}",
          columns: [
              {data:'DT_RowIndex', name: 'DT_RowIndex'},
              {data: 'name', name: 'name', orderable: false},
              {data: 'email', name: 'email', orderable: false},
              {data: 'address', name: 'address', orderable: false},
              {data: 'city', name: 'city', orderable: false},
              {data: 'amount', name: 'amount', orderable: false},
              {data: 'role', name: 'role', orderable: false},
              {data: 'status', name: 'status', orderable: false},
              {data: 'action', name: 'action', orderable: false, searchable: false},
          ]
      });
      
    });
  </script>



@endsection

@endsection