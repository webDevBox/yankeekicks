<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    public const Status = [
        'Un Read' => 0,
        'Read' => 1
    ];

    protected $fillable = [
        'user_id' , 'title' , 'body' , 'status'
    ];

    protected $hidden = [
        'created_at','updated_at'
    ];

    protected $with = [
        'user'
    ];

    public function getStatusAttribute($status)
    {
        return array_search($status , self::Status);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function createTicket($request)
    {
        $ticket = self::create([
            'user_id' => user()->id,
            'title' => $request->title,
            'body' => $request->body
        ]);
        $message = ['error' => 'Ticket Not Create'];
        if($ticket)
            $message = ['success' => 'Ticket Create Successfully'];
        return $message;
    }

    public function pending()
    {
        return self::where('status',0)->get();
    }

    public function getTickets()
    {
        return self::where('user_id',user()->id)->latest()->get();
    }

    public function pendingTicket()
    {
        return self::whereUserId(user()->id)->whereStatus(0)->count();
    }
}
