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
                        <div class="pull-left"><h4 class="text-orange">Tickets List</h4></div>
                        <div class="pull-right">
                            <a href="{{ route('createUserHelp') }}" class="btn btn-success">Create Ticket</a>
                        </div>
                       <div class="clearfix"></div>
                   </div>
                    <p class="text-muted font-14 m-b-30">
                    </p>
                        <table id="datatable" class="table table-bordered table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead class="thead-light">
                            <tr>
                                <th>No</th>
                                <th>Title</th>
                                <th>Body</th>
                                <th>Status</th>
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
          ajax: "{{ route('userHelp') }}",
          columns: [
              {data:'DT_RowIndex', name: 'DT_RowIndex'},
              {data: 'title', name: 'title', orderable: false},
              {data: 'body', name: 'body', orderable: false},
              {data: 'status', name: 'status', orderable: false},
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