<!-- inherite master template app.blade.php -->
@extends('layouts.app')
<!-- define the content section -->
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 ">
            <div class="card">
                <div class="card-header">Create an new Item</div>
                    <!-- display the errors -->
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul> @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li> @endforeach
                        </ul>
                    </div><br /> 
                @endif
                    <!-- display the success status -->
                @if (\Session::has('success'))
                    <div class="alert alert-success">
                        <p>{{ \Session::get('success') }}</p>
                    </div><br />
                @endif
                    <!-- define the form -->
                <div class="card-body">
                    <form class="form-horizontal" method="POST"
                    action="{{url('items')}}" enctype="multipart/form-data">
                    @csrf
                        <div class="col-md-8">
                            <label >Item name</label>
                            <input class="form-control" style="width: 300px;" type="text" name="name"
                            placeholder="Item name" />
                        </div>
                        <div class="col-md-8">
                            <label>Item category</label>
                            <select class="form-control" style="width: 300px;" name="category">
                                <option value="pet">Pet</option>
                                <option value="phone">Phone</option>
                                <option value="jewellery">Jewellery</option>
                            </select>
                            
                        </div>
                        <div class="col-md-8">
                            <label >Item color</label>
                            <input type="text"  style="width: 300px;" class="form-control" name="color"
                            placeholder="item color" />
                        </div>
                        <div class="col-md-8">
                            <label >Place found</label>
                            <input type="text"  style="width: 300px;" class="form-control" name="place_found"
                            placeholder="place found" />
                        </div>
                        <div class="col-md-8">
                            <label >Date and time found</label>
                            <input type="text" style="width: 300px;" class="form-control" name="found_time"
                            placeholder="in 'YYYY-MM-DD hh:mm' format" />
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <label >Notes</label>
                                <textarea class="form-control" name="description" placeholder="any other details of the found item"rows="3">
                                </textarea>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <label>Image</label>
                            <input type="file" name="images[]" placeholder="Image file" multiple>
                        </div>
                        <div class="col-md-6 col-md-offset-4" >
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