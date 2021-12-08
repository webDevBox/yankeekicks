@extends('layouts.auth')
@section('content')
<h4 class="text-center text-dark"> Reset Your Password </h4>
            <form action="{{ route('resetPassword') }}" method="POST" class="p-3">
                @csrf
                  <input type="hidden" value="{{ $user->email }}" name="email" required>
                <div class="mb-3">
                  <label class="form-label">Password</label>
                  <input type="password" name="password" min="6" placeholder="Enter Your Password" @if ($errors->has('password')) class="form-control border border-danger"  @else class="form-control" @endif required>
                  @if ($errors->has('password'))<p style="color:red;">{{ $errors->first('password') }}</p>@endif
                </div>
                <div class="mb-3">
                  <label class="form-label">Confirm Password</label>
                  <input type="password" name="confirm_password" min="6" placeholder="Re-Enter Password" @if ($errors->has('password')) class="form-control border border-danger"  @else class="form-control" @endif required>
                  @if ($errors->has('confirm_password'))<p style="color:red;">{{ $errors->first('confirm_password') }}</p>@endif
                </div>
                <button type="submit" class="btn btn-primary mx-auto d-block">Reset</button>
              </form>
              {{-- <p class="d-inline">Remember account</p><a href="{{ route('userAuth.index') }}"> Login</a> --}}

@endsection