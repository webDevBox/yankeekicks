<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $hidden = [
        'created_at' , 'updated_at'
    ];

    protected $fillable = [
        'user_id', 'type', 'amount'
    ];

    public const Type = [
        'Deposit'  => 0,
        'Withdraw' => 1
    ];

    protected $with = ['user'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function getTypeAttribute($type)
    {
        return array_search($type, self::Type);
    }

    public function getTotalEarning()
    {
        return self::whereUserId(user()->id)->whereType(0)->sum('amount');
    }
}
