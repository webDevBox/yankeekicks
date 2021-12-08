<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ApiResponse;
use App\Http\Requests\ProductSoldRequest;
use App\Services\ProductService;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\DB;
use App\Models\ProductImage;
use App\Models\Product;
use App\Models\User;
use Validator;

class TokenController extends Controller
{
    public function index(Request $request)
    {
        return response()->json(ApiResponse::getToken('TOKEN_CREATED'));
    }
}
