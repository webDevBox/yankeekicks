<!DOCTYPE html>
<html>
<head>
    <title>{{ config('app.name') }}</title>
</head>
<body>
    <h1>Click on link below to reset your password</h1>
    <a href="{{ route('changePassword',[ 'token' => $details['body'] ]) }}" class="btn btn-success">Reset Password</a>
   
    <p>Thank you</p>
</body>
</html>