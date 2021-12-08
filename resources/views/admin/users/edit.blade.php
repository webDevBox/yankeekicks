@extends('layouts.admin')
@section('styles')
 <!-- dropify CSS -->
 <link href="{{ asset('theme/assets/css/dropify.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')

<div class="content">
    <div class="container">
        <div class="row">
                <div class="card-box">
                    <div class="header-title mb-4 col-12">
                        <div><h4 class="text-orange">Edit Profile</h4></div>
                    </div>
                     <form action="{{ route('updateUser',[$user->id]) }}" method="POST">
                        @csrf
                        <div class="row">
                                    <div class="form-group col-6">
                                        <label for="name" class="col-form-label">Name</label>
                                        <input type="text" name="name" value="{{ $user->name }}" class="form-control" required>
                                        @if ($errors->has('name'))<p style="color:red;">{{ $errors->first('name') }}</p>@endif
                                    </div>
                                    <div class="form-group col-6">
                                        <label for="name" class="col-form-label">Email</label>
                                        <input type="email" name="email" value="{{ $user->email }}" class="form-control" readonly>
                                    </div>
                                    <div class="form-group col-6">
                                        <label for="name" class="col-form-label">Address</label>
                                        <textarea name="address" class="form-control" required>{{ $user->address }}</textarea>
                                        @if ($errors->has('address'))<p style="color:red;">{{ $errors->first('address') }}</p>@endif
                                    </div>
                                    <div class="form-group col-6">
                                        <label for="name" class="col-form-label">City</label>
                                        <input type="text" name="city" value="{{ $user->city }}" class="form-control" required>
                                        @if ($errors->has('city'))<p style="color:red;">{{ $errors->first('city') }}</p>@endif
                                    </div>
                                    
                                    <div class="form-group col-6">
                                        <label for="name" class="col-form-label">Status</label>
                                        <select name="status" id="" class="form-control">
                                            <option value="0" @if($user->status == 0) selected @endif>Active</option>
                                            <option value="1" @if($user->status == 1) selected @endif>In Active</option>
                                        </select>
                                        @if ($errors->has('status'))<p style="color:red;">{{ $errors->first('status') }}</p>@endif
                                    </div>
                                    
                                    <div class="form-group col-6">
                                        <label for="name" class="col-form-label">Amount</label>
                                        <input type="number" name="amount" value="{{ $user->amount }}" class="form-control" required>
                                        @if ($errors->has('amount'))<p style="color:red;">{{ $errors->first('amount') }}</p>@endif
                                    </div>
                        </div>
                        <input type="submit" name="submit" value="Update" class="btn btn-primary btn-rounded mx-auto d-block">
                    </form>
                </div>
        </div> <!-- end row -->

    </div> <!-- container -->

</div> <!-- content -->

@endsection

@section('scripts')

@endsection