@extends('layouts.auth')
@section('content')       
<h4 class="text-center text-dark"> Forgot Your Password </h4>
<form action="{{ route('userForgot') }}" method="POST" class="p-3">
    @csrf
    <div class="mb-3">
        <label class="form-label">Email address</label>
        <input type="email" name="email" placeholder="Enter Your Email" value="{{ old('email') }}" @if ($errors->has('email')) class="form-control border border-danger"  @else class="form-control" @endif required>
        @if ($errors->has('email'))<p style="color:red;">{{ $errors->first('email') }}</p>@endif
    </div>
    <button type="submit" class="btn btn-primary mx-auto d-block">Send</button>
    </form>
    <p class="d-inline">Remember account</p><a href="{{ route('userAuth.index') }}"> Login</a>
@endsection