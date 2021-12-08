<?php


namespace App;


use Config;

class ApiResponse
{
    //This is for every request and validate in middleware
    public static function authError($data=null, $key=null)
    {
        $responseConstants = Config::get('constants.RESPONSE_CONSTANTS');

        return [
            'status'        => $responseConstants['STATUS_ERROR'],
            'message'       => $responseConstants[$key]??'Invalid Token',
            'response_code' => $responseConstants['INVALID_PARAMETERS_CODE'],
            'token'         => getToken(),
            'data'          => $data
        ];
    }
    
    public static function getToken($key=null)
    {
        $responseConstants = Config::get('constants.RESPONSE_CONSTANTS');

        return [
            'status'        => $responseConstants['STATUS_SUCCESS'],
            'message'       => $responseConstants[$key]??'Invalid Token',
            'response_code' => $responseConstants['RESPONSE_CODE_SUCCESS'],
            'token'         => getToken()
        ];
    }

    public static function success($data=null, $key=null)
    {
        $responseConstants = Config::get('constants.RESPONSE_CONSTANTS');

        return [
            'status'        => $responseConstants['STATUS_SUCCESS'],
            'message'       => $responseConstants[$key]??'Successfully Get Records',
            'response_code' => $responseConstants['RESPONSE_CODE_SUCCESS'],
            'token'         => getToken(),
            'data'          => $data
        ];
    }

    public static function validation($message=null, $responseCodeKey='INVALID_PARAMETERS_CODE')
    {
        $responseConstants = Config::get('constants.RESPONSE_CONSTANTS');

        return [
            'status'        => $responseConstants['STATUS_ERROR'],
            'message'       => $message,
            'response_code' => $responseConstants[$responseCodeKey],
            'token'         => getToken()
        ];
    }

    public static function error($key=null, $responseCodeKey='INVALID_PARAMETERS_CODE')
    {
        $responseConstants = Config::get('constants.RESPONSE_CONSTANTS');

        return [
            'status'        => $responseConstants['STATUS_ERROR'],
            'message'       => $responseConstants[$key],
            'response_code' => $responseConstants[$responseCodeKey],
            'token'         => getToken()
        ];
    }

    public static function notFound($key=null)
    {
        $responseConstants = Config::get('constants.RESPONSE_CONSTANTS');

        return [
            'response_code' => $responseConstants['RESPONSE_CODE_NOT_FOUND'],
            'status'        => $responseConstants['STATUS_ERROR'],
            'message'       => $responseConstants[$key],
            'type'          => 'resource_not_found',
            'token'         => getToken(),
        ];
    }

    public static function update($key=null)
    {
        $responseConstants = Config::get('constants.RESPONSE_CONSTANTS');

        return [
            'status'        => $responseConstants['STATUS_SUCCESS'],
            'message'       => $responseConstants[$key]??'Successfully Updated Record',
            'response_code' => $responseConstants['RESPONSE_CODE_SUCCESS'],
            'token'         => getToken()
        ];
    }
}