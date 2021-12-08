<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'product_id', 'price', 'shipment_label', 'quantity'
    ];

    protected $hidden = [
        'created_at' , 'updated_at'
    ];

    
}
