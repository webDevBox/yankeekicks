@extends('layouts.admin')
@section('styles')
 <!-- dropify CSS -->
 <link href="{{ asset('theme/assets/css/dropify.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-6 offset-3">
                <div class="card-box">
                    <div class="header-title mb-4 col-12">
                        <div><h4 class="text-orange">Add New User</h4></div>
                    </div>
                    <div class="col-12">
                      <form action="{{ route('userStore') }}" method="POST">
                        @csrf
                        <div class="form-row">
                            <div class="col-12">
                              <input type="hidden" value="123456" name="password" class="form-control">
                                <div class="row">
                                  <div class="form-group col-12">
                                    <label class="form-label">Full Name</label>
                                    <input type="text" name="name" placeholder="Enter Full Name"  value="{{ old('name') }}" @if ($errors->has('name')) class="form-control border border-danger"  @else class="form-control" @endif required>
                                    @if ($errors->has('name'))<p style="color:red;">{{ $errors->first('name') }}</p>@endif
                                  </div>
                                  <div class="form-group col-12">
                                    <label class="form-label">Email address</label>
                                    <input type="email" name="email" placeholder="Enter Email" value="{{ old('email') }}" @if ($errors->has('email')) class="form-control border border-danger"  @else class="form-control" @endif required>
                                    @if ($errors->has('email'))<p style="color:red;">{{ $errors->first('email') }}</p>@endif
                                  </div>
                                  @if(user()->role == 1)
                                    <div class="form-group col-12">
                                      <label class="form-label">Select Role</label>
                                      <select name="role" class="form-control" id="">
                                        <option selected disabled> Select User Role </option>
                                        <option value="2"> Manager </option>
                                        <option value="0"> User </option>
                                      </select>
                                      @if ($errors->has('role'))<p style="color:red;">{{ $errors->first('role') }}</p>@endif
                                    </div>
                                  @endif
                                  <div class="form-group col-12">
                                    <label class="form-label">Address</label>
                                    <textarea name="address" value="{{ old('address') }}" @if ($errors->has('address')) class="form-control border border-danger"  @else class="form-control" @endif required placeholder="Enter Complete Address"></textarea>
                                    @if ($errors->has('address'))<p style="color:red;">{{ $errors->first('address') }}</p>@endif
                                  </div>
                                  <div class="form-group col-12">
                                    <label class="form-label">City</label>
                                    <input type="text" name="city" placeholder="Enter City Name" value="{{ old('city') }}" @if ($errors->has('city')) class="form-control border border-danger"  @else class="form-control" @endif required>
                                    @if ($errors->has('city'))<p style="color:red;">{{ $errors->first('city') }}</p>@endif
                                  </div>
                                </div>
                            </div>
                        </div>
                        <input type="submit" name="submit" value="Register" class="btn btn-primary btn-rounded">
                    </form>
                    </div>

                
                </div>
            </div>
        </div> <!-- end row -->

    </div> <!-- container -->

</div> <!-- content -->

@endsection

@section('scripts')

@endsection