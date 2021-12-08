<!DOCTYPE html>
<html>
<head>
    <title>{{ config('app.name') }}</title>
</head>
<body>
    <h1>{{ $details['subject'] }}</h1>
   <p> {{ $details['body'] }} </p>
   <p> {{ $details['note'] }} </p>
    <p>Thank you</p>
</body>
</html>