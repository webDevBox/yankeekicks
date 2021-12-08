@extends('layouts.auth')
@section('content')
<h4 class="text-center text-dark"> Register on Yankeekicks </h4>
            <form action="{{ route('userAuth.store') }}" method="POST" class="p-3">
                @csrf
                <div class="mb-3">
                  <label class="form-label">Full Name</label>
                  <input type="text" name="name" placeholder="Enter Your Full Name"  value="{{ old('name') }}" @if ($errors->has('name')) class="form-control border border-danger"  @else class="form-control" @endif required>
                  @if ($errors->has('name'))<p style="color:red;">{{ $errors->first('name') }}</p>@endif
                </div>
                <div class="mb-3">
                  <label class="form-label">Email address</label>
                  <input type="email" name="email" placeholder="Enter Your Email" value="{{ old('email') }}" @if ($errors->has('email')) class="form-control border border-danger"  @else class="form-control" @endif required>
                  @if ($errors->has('email'))<p style="color:red;">{{ $errors->first('email') }}</p>@endif
                </div>
                <div class="mb-3">
                  <label class="form-label">Address</label>
                  <textarea name="address" value="{{ old('address') }}" @if ($errors->has('address')) class="form-control border border-danger"  @else class="form-control" @endif required placeholder="Enter Your Complete Address"></textarea>
                  @if ($errors->has('address'))<p style="color:red;">{{ $errors->first('address') }}</p>@endif
                </div>
                <div class="mb-3">
                  <label class="form-label">City</label>
                  <input type="text" name="city" placeholder="Enter Your City Name" value="{{ old('city') }}" @if ($errors->has('city')) class="form-control border border-danger"  @else class="form-control" @endif required>
                  @if ($errors->has('city'))<p style="color:red;">{{ $errors->first('city') }}</p>@endif
                </div>
                <div class="mb-3">
                  <label class="form-label">Password</label>
                  <input type="password" name="password" placeholder="Enter Password" @if ($errors->has('password')) class="form-control border border-danger"  @else class="form-control" @endif required>
                  @if ($errors->has('password'))<p style="color:red;">{{ $errors->first('password') }}</p>@endif
                </div>
                <div class="mb-3">
                  <label class="form-label">Confirm Password</label>
                  <input type="password" name="confirmPassword" class="form-control" placeholder="ReEnter Password" required>
                </div>
                <button type="submit" class="btn btn-primary mx-auto d-block">Register</button>
              </form>
              <p class="d-inline">Already have an account</p><a href="{{ route('userAuth.index') }}"> Login</a>
@endsection