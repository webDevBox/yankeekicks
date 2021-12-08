<?php

return [
    'RESPONSE_CONSTANTS' => [
        'STATUS_ERROR'   => false,
        'STATUS_SUCCESS' => true,
        'STATUS_OTHER_ERROR'          => 2,
        'STATUS_ACCOUNT_UNAUTHORIZED' => 3,
        'STATUS_ACCOUNT_SUSPENDED'  => 4,
        'STATUS_ACCOUNT_DELETED'    => 5,
        'STATUS_INVALID_TOKEN'      => 'Invalid Token',
        'STATUS_INVALID_USER_TYPE'  => 7,
        'STATUS_EMAIL_NOT_VERIFIED' => 8,
        'INVALID_PARAMETERS_CODE'   => 422,
        'RESPONSE_CODE_SUCCESS'     => 200,
        'RESPONSE_CODE_NOT_FOUND'   => 404,
        'RESPONSE_CODE_INVALID_CREDENTIALS' => 401,
        'RESPONSE_CODE_NOT_ALLOWED' => 405,
        'MSG_NOT_FOUND' => 'Record Not Found',
        'MSG_UPDATED' => 'Record Updated Successfully',
        'MSG_NOT_UPDATED' => 'Record Not Updated! Please Try Again',
        'MSG_FOUND' => 'Record Found',
        'TOKEN_CREATED' => 'Token created Successfully',
        'PRODUCT_CREATED' => 'Product Created Successfully'
    ],

    'PAGINATION_CONSTANTS' => [
        'KEY_RECORD_PER_PAGE' =>  10,
    ],
];