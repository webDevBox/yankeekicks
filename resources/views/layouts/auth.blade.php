<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('files/images/theme/favicon.png') }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href={{ asset('theme/assets/css/icons.css') }} rel="stylesheet" type="text/css" />
    <link href={{ asset('theme/assets/css/metismenu.min.css') }} rel="stylesheet" type="text/css" />
    <link href={{ asset('theme/assets/css/style.css') }} rel="stylesheet" type="text/css" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>{{ config('app.name') }}</title>
</head>
<body class="account-pages">
  <div class="accountbg" style="background: url('theme/assets/images/bg.jpg');background-size: cover;background-position: center;"></div>


  <div class="wrapper-page account-page-full">
    <div class="card mt-5">
        <div class="card-block">
            <div class="account-box">
                <div class="card-box p-5">
                    <h2 class="text-uppercase text-center pb-4">
                        <img src="{{ asset('files/images/theme/logo.png') }}" width="120" alt="user-img" title="">
                    </h2>
                    <div class="bg-light p-3">
                      @yield('content')
                    </div>
                    @if (Session::has('success'))
                      <p class="shower alert alert-success">{{ Session::get('success') }}</p>
                    @endif
                    @if (Session::has('error'))
                      <p class="shower alert alert-danger">{{ Session::get('error') }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <script>
        $('.shower').css({'position':'fixed' , 'top':'0' , 'right' : '0' , 'margin-top':'10px' , 'margin-right':'10px'});
        
        $('.shower').click(function(){
          $('.shower').hide(1000);
        });
      </script>
  </body>
  </html>