<?php

namespace App\Http\Controllers\common;

use App\Http\Controllers\Controller;
use App\Http\Requests\TicketRequest;
use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\User;
use DataTables;

class HelpController extends Controller
{

    public function index(Request $request)
    {
        $items = Contact::getTickets();
        if ($request->ajax()) {
            return Datatables::of($items)
            ->addIndexColumn()
                ->addColumn('title', function($title){

                        return $title->title;
                })
                ->addColumn('body', function($body){

                        return $body->body;
                })
                ->addColumn('status',function ($status) {
                    if ($status->status == 'Read') return '<label class="badge badge-success">'.$status->status.'</label>';
                    if ($status->status == 'Un Read') return '<label class="badge badge-warning">'.$status->status.'</label>';
                    })
                ->rawColumns(['status'])
                ->make(true);     
        }
        return view('user.support.index');
    }

    public function help()
    {
        return view('user.support.create');
    }

    public function store(TicketRequest $request)
    {
        $ticket = Contact::createTicket($request);
        return redirect()->route('userHelp')->with($ticket);
    }

    public function tickets(Request $request)
    {
        $items = Contact::latest()->get();
        if ($request->ajax()) {
            return Datatables::of($items)
            ->addIndexColumn()
                ->addColumn('user', function($user){

                        return $user->user->name;
                })
                ->addColumn('title', function($title){

                        return $title->title;
                })
                ->addColumn('body', function($body){

                        return $body->body;
                })
                ->addColumn('status',function ($status) {
                    if ($status->status == 'Un Read') return '<label class="clock_'.$status->id.'"> <select class="form-control clock_'.$status->id.'" onchange="changer('.$status->id.')"> 
                        <option selected disabled>'.$status->status.'</option>
                        <option value="1">Read</option>
                    </select> </label>';
                    if ($status->status == 'Read') return '<label class="badge badge-success">'.$status->status.'</label>';
                    })
                ->addColumn('action',function ($action) {
                    
                    return '<a onclick="myFunction('.$action->id.')" class="btn btn-danger btn-sm rounded ml-3"> <i class="fa fa-trash" aria-hidden="true"></i> </a>';
                    })
                ->rawColumns(['status','action'])
                ->make(true);     
        }
        return view('admin.tickets.tickets');
    }

    public function destroy($id)
    {
        Contact::where('id',$id)->delete();
        return redirect()->back()->with('success','Ticket Deleted');
    }

    public function ticketStatus(Request $request)
    {
        Contact::where('id',$request->id)->update([
            'status' => 1
        ]);
        return response()->json(['success'=>'Status Updated','id'=>$request->id]);
    }
}
