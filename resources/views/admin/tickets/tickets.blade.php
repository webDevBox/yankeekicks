@extends('layouts.admin')
@section('styles')

@endsection

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card-box">
                    <div class="header-title mb-4 col-12">
                        <div class="pull-left"><h4 class="text-orange">Tickets List</h4></div>
                       <div class="clearfix"></div>
                   </div>
                    <p class="text-muted font-14 m-b-30">
                    </p>
                        <table id="datatable" class="table table-bordered table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead class="thead-light">
                            <tr>
                                <th>No</th>
                                <th>User</th>
                                <th>Title</th>
                                <th>Body</th>
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
          ajax: "{{ route('tickets') }}",
          columns: [
              {data:'DT_RowIndex', name: 'DT_RowIndex'},
              {data: 'user', name: 'user', orderable: false},
              {data: 'title', name: 'title', orderable: false},
              {data: 'body', name: 'body', orderable: false},
              {data: 'status', name: 'status', orderable: false},
              {data: 'action', name: 'action', orderable: false, searchable: false},
          ]
      });
      
    });
  </script>

  <script>
       function changer(id)
       {
        $.ajax({
        type: "GET",
        dataType: "json",
        url: '{{ route("ticketStatus") }}',
        data: {'id': id},
        success: function(data){
                $('.clock_'+data.id).html("<label class='badge badge-success'>Read</label>")
            }
        });
       }
  </script>

  <script>
      function myFunction(id)
      {
        if (confirm('Are you sure to delete ticket'))
        {
            var url = '{{ route("ticketsDelete", ":id") }}';
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