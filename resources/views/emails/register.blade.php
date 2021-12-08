<!DOCTYPE html>
<html>
<head>
    <title>{{ config('app.name') }}</title>
</head>
<body>
    <h1>Click on link below to verify your account</h1>
    <a href="{{ route('verifyAccount',[ 'token' => $details['body'] ]) }}" class="btn btn-success">Verify</a>
   <p>Your Password is {{ $details['password'] }}</p>
    <p>Thank you</p>
</body>
</html>