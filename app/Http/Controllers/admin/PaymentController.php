<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Services\PaymentService;
use Illuminate\Http\Request;
use DataTables;
use App\Models\User;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $payment = PaymentService::getPendingPayment();
        if ($request->ajax()) {
            return Datatables::of($payment)
            ->addIndexColumn()
                ->addColumn('user', function($user){

                        return $user->name;
                })
                ->addColumn('amount', function($amount){

                        return '$'.$amount->amount;
                })
                ->addColumn('action',function ($action) {
                    $btn = '<a href="'.route("userTransaction",[$action->id]).'" class="btn btn-success btn-sm rounded ml-3"> <i class="fa fa-eye" aria-hidden="true"></i> </a>';

                    return $btn;
                    })
                ->rawColumns(['action'])
                ->make(true);     
        }
        return view('admin.payment.index');
    }
    
    
    public function paid(Request $request)
    {
        $payment = PaymentService::getPaidPayment();
        if ($request->ajax()) {
            return Datatables::of($payment)
            ->addIndexColumn()
                ->addColumn('user', function($user){

                        return $user->user->name;
                })
                ->addColumn('amount', function($amount){

                        return '$'.$amount->amount;
                })
                ->addColumn('date', function($date){

                        return parseByFormat($date->created_at);
                })
                ->make(true);     
        }
        return view('admin.payment.paid');
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
    public function show(Request $request,$id)
    {
        $payment = PaymentService::getPaymentById($id);
        $user = User::find($id);
        if ($request->ajax()) {
            return Datatables::of($payment)
            ->addIndexColumn()
                ->addColumn('type', function($type){

                        return $type->type;
                })
                ->addColumn('amount', function($amount){

                        return '$'.$amount->amount;
                })
                ->addColumn('date', function($date){

                        return parseByFormat($date->created_at);
                })
                ->make(true);     
        }
        return view('admin.payment.show',compact('user'));
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
