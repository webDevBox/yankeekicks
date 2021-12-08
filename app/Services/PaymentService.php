<?php

namespace App\Services;

use App\Models\ProductImage;
use App\Models\Transaction;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;
use App\Models\User;

class PaymentService
{
    public function getPaymentById($id)
    {
        $payment = Transaction::whereUserId($id)->latest()->get();
        return $payment;
    }
    
    public function getPaidPayment()
    {
        $payment = Transaction::whereType(1)->latest()->get();
        return $payment;
    }

    public function getPendingPayment()
    {
        $pending = User::whereRole(0)->Where('amount','>',0)->get();
        return $pending;
    }

}