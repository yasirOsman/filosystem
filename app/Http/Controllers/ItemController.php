<?php

namespace App\Http\Controllers;

use Storage;
use App\Item;
use App\User;
use App\Requests;
use Illuminate\Support\Facades\Mail;
use App\Mail\ApproveEmail;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        $sort = $request->input('sort');
        $itemList = Item::all()->toArray();
        if($sort == 1){
            $items = collect($itemList)->sortBy('found_time')->all();
            return view('items.index', compact('items'));
        }else if($sort == 2){
            $items = collect($itemList)->sortByDesc('found_time')->all();
            return view('items.index', compact('items'));
        }else if ($sort == 3){
            $items = collect($itemList)->sortBy('category')->all();
            return view('items.index', compact('items'));
        }
        $items = $itemList;
        return view('items.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('items.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // form validation
        $item = $this->validate(request(), [
            'name'=> 'required',
            'color' => 'required',
            'image' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:500',
            'found_time'=> 'required|date_format:Y-m-d H:i'
            ]);
            
            $images=array();
            //Handles the uploading of the image
            if ($files=$request->file('images')){
            //Gets the filename with the extension
            
            foreach($files as $file){
                $fileNameWithExt = $file->getClientOriginalName();
                //just gets the filename
                $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
                //Just gets the extension
                $extension = $file->getClientOriginalExtension();
                //Gets the filename to store
                $fileNameToStore = $filename.'_'.time().'.'.$extension;
                //Uploads the image
                $path = 'images/' . $fileNameToStore;
                $images[]= $fileNameToStore;
                Storage::disk('s3')->put($path, file_get_contents($file));
            }
            $image = implode("|", $images);
            }
            else {
            $image = 'noimage.jpg';
            }
            
            // create an item object and set its values from the given input
            $item = new Item;
            $item->color = $request->input('color');
            $item->name = $request->input('name');
            $item->description = $request->input('description');
            $item->place_found = $request->input('place_found');
            $item->found_time= $request->input('found_time');
            $item->user_found = auth()->user()->id;
            $item->category = $request->input('category');
            $item->created_at = now();
            $item->image = $image;
            // save the Item obj
            $item->save();
            // generate a redirect and success message
            return back()->with('success', 'Item has been added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = Item::find($id);
        $imageList = explode('|', $item->image);
        $url = 'https://s3.' . env('AWS_DEFAULT_REGION') . '.amazonaws.com/' . env('AWS_BUCKET') . '/images/';

        foreach($imageList as $image){
            $images[] = $url . $image;
        }

        return view('items.show',compact(['item','images']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Item::find($id);
        return view('items.edit',compact('item'));
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
        // form validation
        $item = Item::find($id);
        
        $this->validate(request(), [
            'name'=> 'required',
            'color' => 'required',
            'image' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:500',
            'found_time'=> 'required|date_format:Y-m-d H:i:s'
            ]);
            
            $images=array();
            //Handles the uploading of the image
            if ($files=$request->file('images')){
            //Gets the filename with the extension
            foreach($files as $file){
                $fileNameWithExt = $file->getClientOriginalName();
                //just gets the filename
                $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
                //Just gets the extension
                $extension = $file->getClientOriginalExtension();
                //Gets the filename to store
                $fileNameToStore = $filename.'_'.time().'.'.$extension;
                //Uploads the image
                // $path =$file->storeAs('public/images', $fileNameToStore);
                $path = 'images/' . $fileNameToStore;
                $images[]= $fileNameToStore;
                Storage::disk('s3')->put($path, $file, 'public');
            }
            $image = implode("|", $images);
            $item->image = $image;
            }
            
            $item->color = $request->input('color');
            $item->name = $request->input('name');
            $item->description = $request->input('description');
            $item->place_found = $request->input('place_found');
            $item->found_time= $request->input('found_time');
            $item->user_found = auth()->user()->id;
            $item->category = $request->input('category');
            $item->created_at = now();
            // save the Item obj
            $item->save();
            // generate a redirect and success message
            return back()->with('success', 'Item has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {   
        $page = $request->input('page');
        
        if($page == 1){
            $theRequest = Requests::find($id);
            $item = Item::find($theRequest->item_id);
            $user = User::find($theRequest->user_id);

            $images = explode('|', $item->image);
        
            foreach($images as $image){
            Storage::disk('s3')->delete('images/' . $image);
            }

            Mail::to($user->email)->send(new ApproveEmail($item,$user));
            $item->delete();
            return redirect('requests')->with('success','Request has been approved and item has been deleted!');
        }
        
        $item = Item::find($id);
        $images = explode('|', $item->image);
        
        foreach($images as $image){
            Storage::disk('s3')->delete('images/' . $image);
        }
        
        $item->delete();
        return redirect('items')->with('success','Item has been deleted!');
    }
}
