<?php

namespace App\Http\Controllers;

use App\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\DenyEmail;
use App\Item;
use App\User;

class RequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $requests = Requests::all()->toArray();
        return view('requests.index', compact('requests'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $itemId = array($id);
        return view('requests.create',compact('itemId'));
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //form validation
        $userRequest = $this->validate(request(), [
            'reason' => 'required'
        ]);

        $userRequest = new Requests;
        $userRequest->reason = $request->input('reason');
        $userRequest->user_id = auth()->user()->id;
        $userRequest->item_id = $request->input('id');
        $userRequest->created_at = now();
        $userRequest->save();

        return back()->with('success', 'Request has been sent!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $request = Requests::find($id);
        $item = Item::find($request->item_id);
        $user = User::find($request->user_id);
        Mail::to($user->email)->send(new DenyEmail($item,$user));
        $request->delete();
        return redirect('requests')->with('success','Request has been denied');
    }

}
