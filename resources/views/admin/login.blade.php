@extends('layouts.auth')
@section('content')
<h4 class="text-center text-dark"> Yankeekicks Admin Login</h4>
        <form action="{{ route('adminLogin') }}" method="POST" class="p-3">
            @csrf
            <div class="mb-3">
                <label class="form-label">Email address</label>
                <input type="email" name="email" placeholder="Enter Your Email" value="{{ old('email') }}" @if ($errors->has('email')) class="form-control border border-danger"  @else class="form-control" @endif required>
                @if ($errors->has('email'))<p style="color:red;">{{ $errors->first('email') }}</p>@endif
            </div>
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" placeholder="Enter Password" @if ($errors->has('password')) class="form-control border border-danger"  @else class="form-control" @endif required>
                @if ($errors->has('password'))<p style="color:red;">{{ $errors->first('password') }}</p>@endif
            </div>
            <div class="offset-9">
                <a href="{{ route('forgot') }}"> Need Help?</a>
            </div>
            <button type="submit" class="btn btn-primary mx-auto d-block">Login</button>
        </form>
@endsection