<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ProductService;
use App\Http\Requests\ProductRequest;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\DB;
use App\Models\ProductImage;
use App\Models\Product;
use App\Models\User;
use DataTables;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = User::getUsers();
        if ($request->ajax()) {
            return Datatables::of($users)
            ->addIndexColumn()
                ->addColumn('name', function($name){

                        return $name->name;
                })
                ->addColumn('email', function($email){

                        return $email->email;
                })
                ->addColumn('address', function($address){

                        return $address->address;
                })
                ->addColumn('city', function($city){

                        return $city->city;
                })
                ->addColumn('amount', function($amount){
                    
                    return '$'.$amount->amount;
                })
                ->addColumn('role', function($role){
                        if($role->role == 0) return '<label class="badge badge-info">Seller</label>';
                        return '<label class="badge badge-info">Manager</label>';
                })
                ->addColumn('status',function ($status) {
                    if ($status->status == 0) return '<label class="badge badge-success">Active</label>';
                    if ($status->status == 1) return '<label class="badge badge-danger">In Active</label>';
                    })
                ->addColumn('action',function ($action) {
                    $btn = '<a href="'.route("userEdit",[$action->id]).'" class="btn btn-success btn-sm rounded ml-3"> <i class="fa fa-pencil" aria-hidden="true"></i> </a>';

                    return $btn;
                    })
                ->rawColumns(['role', 'status','action'])
                ->make(true);     
        }
        return view('admin.users.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        if(!isset($request->role))
            $request->role = 0;
        $user = User::createUser($request);
        return redirect()->route('manageUsers')->with($user['alert']);
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
        $user = User::findOrFail($id);
        return view('admin.users.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
        $user = User::updateUser($request,$id);
        return redirect()->route('manageUsers')->with($user);
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
