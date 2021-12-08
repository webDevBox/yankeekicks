<?php

namespace App\Services;

use App\Models\ProductImage;
use App\Models\Transaction;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class ProductService
{
    public function productList()
    {
        $request = Http::post(config('services.shopify')['product_list'],[
            'shop' => config('services.shopify')['shop_name'],
            'token' => config('services.shopify')['token']
        ]);

        return json_decode($request,true);
    }

    public function productSearch($input)
    {
        $request = Http::post(config('services.shopify')['product_list'],[
            'shop' => config('services.shopify')['shop_name'],
            'token' => config('services.shopify')['token']
        ]);
        if($input != '')
        {
            $request = Http::post(config('services.shopify')['product_by_id'],[
                'shop' => config('services.shopify')['shop_name'],
                'token' => config('services.shopify')['token'],
                'product_name' => $input
            ]);
        }
        return json_decode($request,true);
    }

    public function getProductById($id)
    {
        $request = Http::post(config('services.shopify')['product_by_id'],[
            'shop' => config('services.shopify')['shop_name'],
            'token' => config('services.shopify')['token'],
            'product_id' => $id
        ]);

        return json_decode($request,true);
    }

    public function updateProduct($request)
    {
        $product = Product::where('id',$request->id)->where('user_id',user()->id)
        ->where('status',0)->update([
            'price' => $request->price,
            'size' => $request->size,
            'condition' => $request->condition,
            'delivery' => $request->delivery,
            'quantity' => $request->quantity,
            'total_qty' => $request->quantity
        ]);
        if($product)
            return $product;
        return false;
    }
    
    
    public function updateProductImages($request)
    {
        $oldImages = ProductImage::where('product_id',$request->id)->get();
        foreach($oldImages as $oldImage)
        {
            Storage::delete($oldImage->image);
        }
        ProductImage::where('product_id',$request->id)->delete();
        foreach($request->images as $file)
        {
            $imagesData[] = ['product_id' => $request->id, 'image' => $file->store('images/products')];
        }
        $productImage = ProductImage::insert($imagesData);
        if($productImage)
            return true;
        return false;
    }

    public function createProduct($request)
    {
        $check = 0;
        while($check == 0)
        {
            $random = random();
            $randomCheck = Product::where('shipment_label',$random)->first();
            if(!isset($randomCheck))
            {
                $check = 1;
            }
        }
        $product = Product::create([
            'user_id' => user()->id,
            'product_id' => $request->product_id,
            'price' => $request->price,
            'shipment_label' => $random,
            'size' => $request->size,
            'condition' => $request->condition,
            'delivery' => $request->delivery,
            'quantity' => $request->quantity,
            'total_qty' => $request->quantity
        ]);
        if($product)
            return $product;
        return false;
    }
    
    public function createProductImages($request,$id)
    {
        foreach($request->images as $file)
        {
            $imagesData[] = ['product_id' => $id, 'image' => $file->store('images/products')];
        }
        $productImage = ProductImage::insert($imagesData);
        if($productImage)
            return true;
        return false;
    }

    public function productSold($request)
    {
        $data = array();
        $product = Product::find($request->id);
        $price = $request->quantity * $product->price;
        $amount = $price - 30;
        if((($price * 30) / 100) > 30)
            $amount = $price - (($price * 30) / 100);
        
        $qty = $product->quantity - $request->quantity;
        $status = 1;
        if($qty == 0)
            $status = 3;
        
        DB::beginTransaction();
            Transaction::create([
                'user_id' => $product->user_id,
                'type' => 0,
                'amount' => $amount
            ]);
            User::where('id',$product->user_id)->increment('amount',$amount);
            $update = $product->update([
                'quantity' => $qty,
                'status' => $status
            ]);
        DB::commit();
        DB::rollBack();
        
        if($update)
            return $product;
        return false;
    }

    public function getTopPriceProduct($request)
    {
        $product = Product::where('product_id',$request->product_id)
        ->where('size',$request->variant)->where('status',1)
        ->orderBy('price','asc')->first();
        if(isset($product))
            return $product;
        return false;
    }
    
    public function getTopPriceProductWeb($id,$variant)
    {
        return Product::whereProductId($id)->whereSize($variant)
        ->whereStatus(1)->orderBy('price','asc')->get();
    }

    public function totalConsignment()
    {
        return Product::whereUserId(user()->id)->count();
    }

    public function productStore($request)
    {
        $user = User::whereRole(3)->first();
        foreach($request->variant as $variant)
        {
            $products[] = ['user_id' => $user->id, 'product_id' => $request->product_id,
                'status' => 1, 'price' => $variant['price'], 'size' => $variant['size'],
                'condition' => $variant['condition'], 'quantity' => $variant['quantity'],
                'total_qty' => $variant['quantity']];
        }
        $product = Product::insert($products);
        if($product)
            return $products;
        return null;
    }

    public function getLimitedProducts($limit)
    {
        return Product::whereStatus(1)->latest()->take($limit)->get();
    }

}
