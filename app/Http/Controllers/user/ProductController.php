<?php

namespace App\Http\Controllers\user;

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
    public function index(Request $request)
    {
        if ($request->ajax()){
            $data = ProductService::productSearch($request->get('title'));
            return view('partials._show_products',compact('data'));
        }
        $data = ProductService::productList();
        return view('user.product.index',compact('data'));
    }

    public function search(Request $request)
    {
        $data = array();
        $products = ProductService::productSearch($request->input);
        return view('partials._show_products', compact('products'));
    }
    
    public function list(Request $request)
    {
        $items = Product::where('user_id',user()->id)->latest()->get();
        if ($request->ajax()) {
            return Datatables::of($items)
            ->addIndexColumn()
                ->addColumn('product', function($product){

                        return $product->product_id['response']['title'];

                })
                ->addColumn('price', function($price){

                        return '$' . $price->price;
                })
                ->addColumn('size', function($size){

                        return $size->size;
                })
                ->addColumn('condition', function($condition){

                        return $condition->condition;
                })
                ->addColumn('delivery', function($delivery){

                        return $delivery->delivery;
                })
                ->addColumn('quantity', function($quantity){

                        return $quantity->quantity;
                })
                ->addColumn('status',function ($status) {
                    if ($status->status == 'Pending') return '<label class="badge badge-warning">'.$status->status.'</label>';
                    if ($status->status == 'Approved') return '<label class="badge badge-primary">'.$status->status.'</label>';
                    if ($status->status == 'Rejected') return '<label class="badge badge-danger">'.$status->status.'</label>';
                    if ($status->status == 'Sold') return '<label class="badge badge-success">'.$status->status.'</label>';
                   })
                ->addColumn('action',function ($action) {
                    $btn = '';
                    if($action->status == 'Pending')
                    {
                        $btn.= '<a href="'.route("productEdit",[$action->id]).'" class="btn btn-warning btn-sm rounded"> <i class="fa fa-pencil" aria-hidden="true"></i> </a>';
                    }
                    $btn.= '<a href="'.route("productShow",[$action->id]).'" class="btn btn-success btn-sm rounded ml-3"> <i class="fa fa-eye" aria-hidden="true"></i> </a>';

                    return $btn;
                    })
                ->rawColumns(['status','action'])
                ->make(true);     
        }
        return view('user.product.list');
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('user.product.show',compact('product'));
    }

    public function create($id)
    {
        $product = ProductService::getProductById($id);
        return view('user.product.create',compact('product'));
    }

    public function store(ProductRequest $request)
    {
        DB::beginTransaction();
            $product = ProductService::createProduct($request);
            $productImages = ProductService::createProductImages($request,$product->id);
        DB::commit();
        DB::rollBack();
        return redirect()->route('listItem')->with('success' , 'Product Added Successfully');
    }
    
    public function update(ProductRequest $request)
    {
        DB::beginTransaction();
            $product = ProductService::updateProduct($request);
            if(isset($request->images))
                $productImages = ProductService::updateProductImages($request);
        DB::commit();
        DB::rollBack();
        return redirect()->back()->with('success' , 'Product Updated Successfully');
    }

    public function edit($id)
    {
        $myProduct = Product::where('user_id',user()->id)->where('id',$id)
        ->where('status',0)->firstOrFail();
        $product = ProductService::getProductById($myProduct->getRawOriginal('product_id'));
        return view('user.product.edit',compact('myProduct','product'));
    }
}
