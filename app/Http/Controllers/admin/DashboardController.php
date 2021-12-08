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
use App\Models\Contact;
use App\Models\User;
use DataTables;

class DashboardController extends Controller
{
    public $per_page_record = 0;
    public function __construct()
    {
        $this->per_page_record = config('constants.PAGINATION_CONSTANTS')['KEY_RECORD_PER_PAGE'];
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::getUsers();
        $recentUsers = User::getLimitedUsers($this->per_page_record);
        $recentProducts = ProductService::getLimitedProducts($this->per_page_record);
        $sellers = User::getUsersWithProducts();
        $products = Product::all();
        $contacts = Contact::pending();
        return view('admin.dashboard.dashboard',
        compact('users','sellers','products','contacts','recentUsers','recentProducts'));
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
