<?php

namespace App\Http\Controllers\admin\product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ProductService;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\DB;
use App\Models\ProductImage;
use App\Models\Product;
use DataTables;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $products = ProductService::productList();
        if ($request->ajax()) {
            return Datatables::of($products['response'])
            ->addIndexColumn()
                ->addColumn('product', function($product){

                        return $product['title'];
                })
                ->addColumn('status', function($status){

                        return $status['status'];
                })
                ->addColumn('variants', function($variants){
                        return count($variants['variants']);
                })
                ->addColumn('action',function ($action) {

                    return '<a href="'.route("adminProductVariants",[$action['id']]).'" class="btn btn-success btn-sm rounded ml-3"> <i class="fa fa-eye" aria-hidden="true"></i> </a>';

                    })
                ->rawColumns(['action'])
                ->make(true);     
        }
        return view('admin.product.index');
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$id)
    {
        $product = ProductService::getProductById($id);
        if ($request->ajax()) {
            return Datatables::of($product['response']['variants'])
            ->addIndexColumn()
                ->addColumn('title', function($title){

                        return $title['title'];
                })
                ->addColumn('price', function($price){

                        return '$'.$price['price'];
                })
                ->addColumn('sku', function($sku){
                        return $sku['sku'];
                })
                ->addColumn('action',function ($action) {
                    
                    return '<a href="'.route("adminVariants",[$action['product_id'],$action['title']]).'" class="btn btn-success btn-sm rounded ml-3"> <i class="fa fa-eye" aria-hidden="true"></i> </a>';

                    })
                ->rawColumns(['action'])
                ->make(true);     
        }
        return view('admin.product.show',compact('id'));
        
    }
    
    
    public function items(Request $request,$id,$variant)
    {
        $items = ProductService::getTopPriceProductWeb($id,$variant);
        if ($request->ajax()) {
            return Datatables::of($items)
            ->addIndexColumn()
                ->addColumn('user', function($user){

                        return $user->user->name;
                })
                ->addColumn('price', function($price){

                        return '$'.$price->price;
                })
                ->addColumn('shipping', function($shipping){
                        return $shipping->shipment_label;
                })
                ->addColumn('condition', function($condition){
                        return $condition->condition;
                })
                ->addColumn('quantity', function($quantity){
                        return $quantity->quantity;
                })
                ->make(true);     
        }
        return view('admin.product.items',compact('id','variant'));
        
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
    public function update(Request $request, $id)
    {
        //
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
