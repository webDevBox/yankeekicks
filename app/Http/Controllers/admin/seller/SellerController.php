<?php

namespace App\Http\Controllers\admin\seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ProductService;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\Mail;
use App\Mail\YankeekickMail;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\DB;
use App\Jobs\StatusChangeJob;
use App\Models\ProductImage;
use App\Models\Product;
use App\Models\User;
use DataTables;

class SellerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $consignments = Product::getConsignments();
        if ($request->ajax()) {
            return Datatables::of($consignments)
            ->addIndexColumn()
                ->addColumn('seller', function($seller){
                        return $seller->user->name;
                })
                ->addColumn('product', function($product){
                        return $product->product_id['response']['title'];
                })
                ->addColumn('shipping', function($shipping){
                        return $shipping->shipment_label;
                })
                ->addColumn('status', function($status){
                    if($status->status == "Pending"){
                    return '<label class="clock_'.$status->id.'">
                    <select class="form-control clicker_'.$status->id.'" onchange="changer('.$status->id.')">
                    <option value="0" selected>Pending</option>
                    <option value="1">Approved</option>
                    <option value="2">Rejected</option>
                    </select>
                    </label>';
                    }
                    else
                    {
                        if ($status->status == 'Approved') return '<label class="badge badge-info">'.$status->status.'</label>';
                        if ($status->status == 'Rejected') return '<label class="badge badge-danger">'.$status->status.'</label>';
                        if ($status->status == 'Sold') return '<label class="badge badge-success">'.$status->status.'</label>';
                    } 
                })
                ->addColumn('action',function ($action) {
                    $btn = '';
                    $btn .= '<a href="'.route('userProducts',[$action->id]).'" class="btn btn-success btn-sm rounded"> <i class="fa fa-eye" aria-hidden="true"></i> </a>';
                    if($action->status == "Pending")
                        $btn .= '<a onclick="myFunction('.$action->id.')" class="btn btn-danger btn-sm rounded ml-2"> <i class="fa fa-trash" aria-hidden="true"></i> </a>';
                    return $btn;
                    })
                ->rawColumns(['status','action'])
                ->make(true);     
        }
        return view('admin.seller.index');
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
        $product = Product::findOrFail($id);
        return view('admin.seller.products',compact('product'));
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

    public function productStatus($id,$status,$note)
    {
        if($note == '')
            $note = 'No Note Provided';
        if($note == 'null')
            $note = null;
        Product::where('id',$id)->update([
            'status' => $status,
            'note' => $note
        ]);
        $message = 'Rejected';
        if($status == 1)
            $message = 'Approved';

        $consignment = Product::find($id);
        $details = [
            'subject' => 'Consignment Status',
            'body' => 'Your Consignment '.$message.' by admin',
            'note' => $note,
            'view' => 'consignment',
            // 'email' => $consignment->user->email
        ];

        Mail::to($consignment->user->email)->send(new YankeekickMail($details));
        // dispatch(new StatusChangeJob($details));
        return response()->json(['success'=>'Status Updated']);
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
        Product::where('id',$id)->delete();
        return redirect()->back()->with('success','Product Deleted Successfully');
    }
}
