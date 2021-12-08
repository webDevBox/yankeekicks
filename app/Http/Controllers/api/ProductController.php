<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ApiResponse;
use App\Http\Requests\ProductSoldRequest;
use App\Services\ProductService;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use App\Models\ProductImage;
use App\Models\Product;
use App\Models\User;
use Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_id' => 'required|numeric',
            'variant.*' => 'Array',
            'variant.*.size' => 'required',
            'variant.*.price' => 'required|numeric',
            'variant.*.condition' => ['required', Rule::in([0,1])],
            'variant.*.quantity' => 'required|numeric'
        ]);

        $message = $validator->errors()->first();
        if ($validator->fails()) {
            return response()->json(ApiResponse::validation($message));
        }
        $product = ProductService::productStore($request);
        $data['product'] = $product;
        return response()->json(ApiResponse::success($data,'PRODUCT_CREATED'));
    }

    public function getTopVariant(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_id' => 'required|numeric|exists:products,product_id',
            'variant' => 'required|exists:products,size'
        ]);

        $message = $validator->errors()->first();
        if ($validator->fails()) {
            return response()->json(ApiResponse::validation($message));
        }

        $product = ProductService::getTopPriceProduct($request);
        if($product)
        {
            $data['product'] = $product;
            return response()->json(ApiResponse::success($data,'MSG_FOUND'));
        }
        return response()->json(ApiResponse::error('MSG_NOT_FOUND','RESPONSE_CODE_NOT_FOUND'));

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|numeric|exists:products,id',
            'quantity' => 'required|numeric'
        ]);

        $message = $validator->errors()->first();
        if ($validator->fails()) {
            return response()->json(ApiResponse::validation($message));
        }
        $product = ProductService::productSold($request);
        
        if($product)
        {
            $data['product'] = $product;
            return response()->json(ApiResponse::success($data,'MSG_UPDATED'));
        }
        return response()->json(ApiResponse::error('MSG_NOT_UPDATED','MSG_UPDATED'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
