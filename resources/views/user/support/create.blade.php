@extends('layouts.user')
@section('styles')
 <!-- dropify CSS -->
 <link href="{{ asset('theme/assets/css/dropify.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card-box">
                    <div class="header-title mb-4 col-12">
                        <div><h4>Create Ticket For Admin</h4></div>
                    </div>
                <div class="col-12">
                     <form action="{{ route('helpStore') }}" method="POST">
                        @csrf
                        <div class="form-row">
                           <div class="form-group col-12">
                                <label for="name" class="col-form-label">Title</label>
                                <input type="text" name="title" placeholder="Enter Title" @if ($errors->has('title')) class="form-control border border-danger"  @else class="form-control" @endif required>
                                @if ($errors->has('title'))<p style="color:red;">{{ $errors->first('title') }}</p>@endif
                            </div>
                            <div class="form-group col-12">
                                <label class="col-form-label">Body</label>
                                <textarea name="body" @if ($errors->has('body')) class="form-control border border-danger"  @else class="form-control" @endif placeholder="Enter Body" required></textarea>
                                @if ($errors->has('body'))<p style="color:red;">{{ $errors->first('body') }}</p>@endif
                            </div>
                        </div>
                        <input type="submit" name="submit" value="Send Ticket" class="btn btn-primary btn-rounded">
                    </form>
                </div>
                </div>
            </div>
        </div> <!-- end row -->
    </div> <!-- container -->
</div> <!-- content -->

@endsection

@section('script')

@endsection