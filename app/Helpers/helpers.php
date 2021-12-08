<?php

use Carbon\Carbon;

function todayDate()
{
    return now();
}

function timeStamp()
{
    return time();
}

function currentTime()
{
    return todayDate()->toTimeString();
}

function currentDate()
{
    return date("Y-m-d");
}

function year()
{
    return todayDate()->year;
}

function month()
{
    return todayDate()->format('M');
}

function day()
{
    return todayDate()->format('l');
}

function user()
{
    return auth()->user();
}

function userImage()
{
    return 'files/'.user()->image;
}

function userImageByObject($image)
{
    if($image == null)
        return dummyImage();
    return 'files/'.$image;
}

function dummyImage()
{
    return 'files/images/user/dummy.png';
}

function random()
{
    return rand(111111,999999);
}

function getProductImage($image)
{
    if($image == null)
        return asset('theme/assets/images/dummy.jfif');
    return $image;
}

function randomToken()
{
    $token = 'yankeekicks_'.md5(mt_rand());
    \App\Models\TokenAuthenticate::first()->update(['token' => $token]);
    return $token;
}

function getRandomToken()
{
    $token = 'yankeekicks_'.md5(mt_rand());
    return $token;
}

function checkToken($token)
{
    $cross = \App\Models\TokenAuthenticate::first();
    if($token == $cross->token)
        return true;
    return false;
}

function getToken()
{
    $cross = \App\Models\TokenAuthenticate::first();
    return $cross->token;
}

function parseByFormat($date, $format='d/m/Y h:i A')
{
    $date = date_create($date);
    return date_format($date,$format);
}