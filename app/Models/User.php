<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\YankeekickMail;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'address',
        'city',
        'status',
        'role',
        'token',
        'token_generation_time',
        'image'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password' , 'created_at' , 'updated_at'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */

     public function products()
     {
        return $this->hasMany(Product::class);
     }


     public function createUser($request)
     {
        $check = 0;
        while($check == 0)
        {
            $random = random();
            $randomCheck = self::where('token',$random)->first();
            if(!isset($randomCheck))
            {
                $check = 1;
            }
        }
        $data = self::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'address' => $request->address,
            'city' => $request->city,
            'status' => 0,
            'role' => $request->role,
            'token' => $random,
        ]);

        $details = [
            'subject' => 'Verify Email',
            'body' => $random,
            'password' => $request->password,
            'view' => 'register'
        ];

        Mail::to($request->email)->send(new YankeekickMail($details));

        $alert = ['success'=>'Check your email for verification'];
        if(user())
            $alert = ['success'=>'User Added Successfully'];
        $message = ['alert' => $alert , 'data' => $data];
        return $message;
     }

     public function updateProfile($request)
     {
        $user = user();
        $image = null;
        $message = [];
        if(isset($request->password))
        {
            if(Hash::check($request->oldPassword, $user->password))
            {
                $user->update([
                    'password' => bcrypt($request->password)
                ]);
            }
            else
            {
                $message = ['error' => 'Wrong Old Password'];
            }
        }
        if(user()->image != null)
            $image = user()->image;
        if(isset($request->image))
        {
            if(user()->image != null)
            {
                $path = user()->image;
                Storage::delete($path);
            }
            $image = $request->image->store('images/user');
        }
        $email = user()->email;
        if(user()->role == 1)
            $email = $request->email;
        $user->update([
            'name' => $request->name,
            'email' => $email,
            'address' => $request->address,
            'city' => $request->city,
            'image' => $image
        ]);
        $message = ['success' => 'Profile Updated'];
        return $message;
     }

     public function forgotPassword($request)
     {
        $check = 0;
        while($check == 0)
        {
            $random = random();
            $randomCheck = self::where('token',$random)->first();
            if(!isset($randomCheck))
            {
                $check = 1;
            }
        }
        $user = self::where('email',$request->email)->first();
        $user->update(['token' => $random , 'token_generation_time' => currentDate()]);
        
        $details = [
            'subject' => 'Reset Password',
            'body' => $user['token'],
            'view' => 'reset'
        ];
        Mail::to($request->email)->send(new YankeekickMail($details));

        $message = ['success' => 'Please check your email to reset password'];
        $route = 'userAuth.index';
        // if($user->role == 1)
        //     $route = 'adminLoginView';
        $data = ['message' => $message , 'route' => $route];
        return $data;
     }
    
     public function resetPassword($request)
     {
        $error = 0;
        $user = self::where('email',$request->email)->first();
        $difference = date_diff(date_create(currentDate()) , date_create($user->token_generation_time));
        if($difference->format("%a") > 1)
        {
            $user->update(['token' => null , 'token_generation_time' => null]);
            $message = ['error' => 'Your Reset Password Request Time Expired! Try Again'];
            $route = 'forgot';
            $error = 1;
        }

        if($user->token == null && $user->token_generation_time == null)
        {
            $message = ['error' => 'Wrong Practice! Try Again'];
            $route = 'forgot';
            $error = 1;
        }
        
        if($error == 0)
        {
            $user->update(['password' => bcrypt($request->password) , 'token' => null , 'token_generation_time' => null]);
            $message = ['success' => 'Your Password Reset Successfully'];
            $route = 'userAuth.index';
            // if($user->role == 1)
            //     $route = 'adminLoginView';
        }
        $data = ['message' => $message , 'route' => $route];
        return $data;
     }

     public function getUsers()
     {
         if(user()->role == 1)
            return self::where('role',0)->orWhere('role',2)->orderBy('amount','desc')->get();
        return self::where('role',0)->orderBy('amount','desc')->get();
     }
     
     public function getUserById($id)
     {
        return self::findOrFail($id);
     }

     public function updateUser($request,$id)
     {
        self::where('id',$id)->update([
            'name' => $request->name,
            'address' => $request->address,
            'city' => $request->city,
            'status' => $request->status,
            'amount' => $request->amount
        ]);
        return ['success'=>'User Profile Updated'];
     }

     public function getUsersWithProducts()
     {
         return self::has('products')->get();
     }

     public function getLimitedUsers($limit)
     {
        return self::where('role',0)->latest()->take($limit)->get();
     }

     public function getSeller()
     {
         return self::whereRole(0)->get();
     }

     public function getSellerById($id)
     {
        return self::whereRole(0)->find($id);
     }
}
