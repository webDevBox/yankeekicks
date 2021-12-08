<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Services\PaymentService;
use Illuminate\Http\Request;
use DataTables;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function show(Request $request)
    {
        $payment = PaymentService::getPaymentById(user()->id);
        if ($request->ajax()) {
            return Datatables::of($payment)
            ->addIndexColumn()
                ->addColumn('type', function($type){

                        return $type->type;
                })
                ->addColumn('amount', function($amount){

                        return $amount->amount;
                })
                ->addColumn('date', function($date){

                        return parseByFormat($date->created_at);
                })
                ->make(true);     
        }
        return view('user.payment.index');
    }

    public function withdraw()
    {
        return view('user.payment.withdraw');
    }

    public function withdrawAmount(Request $request)
    {
        return redirect()->back()->withSuccess('Amount Transfer Successfully');
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
