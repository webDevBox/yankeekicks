<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Services\ProductService;

class Product extends Model
{
    use HasFactory;

    public const Status = [
        'Pending'  => 0,
        'Approved' => 1,
        'Rejected' => 2,
        'Sold'     => 3
    ];
    
    public const Condition = [
        'New without Shoe Box'  => 1,
        'New with Shoe Box' => 0
    ];

    protected $hidden = [
        'created_at' , 'updated_at'
    ];

    protected $fillable = [
        'user_id', 'product_id', 'status', 'price', 'shipment_label', 'size', 'condition', 'delivery', 'quantity', 'total_qty'
    ];
    
    protected $with = [
        'productImages', 'user'
    ];

    public function getStatusAttribute($status)
    {
        return array_search($status, self::Status);
    }
    
    public function getConditionAttribute($condition)
    {
        return array_search($condition, self::Condition);
    }
    
    public function getProductIdAttribute($product_id)
    {
        $product = ProductService::getProductById($product_id);
        return $product;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function productImages()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function getUserProducts($id)
    {
        return self::where('user_id',$id)->get();
    }

    public function getConsignments()
    {
        return self::latest()->get();
    }
}
