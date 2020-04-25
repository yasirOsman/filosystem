<!-- inherite master template app.blade.php -->
@extends('layouts.app')
<!-- define the content section -->
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10 ">
            <div class="card">
                <div class="card-header">Edit and update the Item</div>
                    <!-- display the errors -->
                    @if ($errors->any())
                    <div class="alert alert-danger">
                    <ul> @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li> @endforeach
                    </ul>
                    </div><br /> @endif
                    <!-- display the success status -->
                    @if (\Session::has('success'))
                    <div class="alert alert-success">
                    <p>{{ \Session::get('success') }}</p>
                    </div><br /> @endif
                    <!-- define the form -->
                    <div class="card-body">
                    <form class="form-horizontal" method="POST"
                    action="{{ action('ItemController@update',$item['id'])}}" enctype="multipart/form-data">
                    @csrf
                    <div class="col-md-8">
                    <label >Item name</label>
                    <input type="text" style="width: 200px;" name="name"
                    placeholder="Item name" />
                    </div>
                    <div class="col-md-8">
                    <label>Item category</label>
                    <select name="category" >
                    <option value="pet">Pet</option>
                    <option value="phone">Phone</option>
                    <option value="jewellery">Jewellery</option>
                    </select>
                    </div>
                    <div class="col-md-8">
                    <label >Item color</label>
                    <input type="text" style="width: 200px;" name="color"
                    placeholder="item color" value="{{$item['color']}}"/>
                    </div>
                    <div class="col-md-8">
                    <label >Place found</label>
                    <input type="text" style="width: 200px;" name="place_found"
                    placeholder="place found" value="{{$item['place_found']}}"/>
                    </div>
                    <div class="col-md-8">
                    <label >Time found</label>
                    <input type="text" style="width: 200px;" name="found_time"
                    placeholder="in 'YYYY-MM-DD hh:mm' format" value="{{$item['found_time']}}"/>
                    </div>
                    <div class="col-md-8">
                    <label >Description</label>
                    <textarea rows="4" cols="50" name="description" placeholder="any other details of the found item" value="{{$item['description']}}"></textarea>
                    </div>
                    <div class="col-md-8">
                    <label>Image</label>
                    <input type="file" name="images[]" placeholder="Image file" value="{{$item['image']}}" multiple>
                    </div>
                    <div class="col-md-6 col-md-offset-4">
                    <input type="submit" class="btn btn-primary" />
                    <input type="reset" class="btn btn-primary" />
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection