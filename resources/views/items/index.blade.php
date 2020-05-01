@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10 ">
            <div class="card" >
                <div class="card-text">
                <a id="dropdownMenuButton" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                Sort By
                </a>
                
                <div class="dropdown-menu dropdown-menu" aria-labelledby="navbarDropdown">
                    <form>
                        @csrf
                        <input type="submit" class="dropdown-item" value="Time found (asc)"/>
                        <input type="hidden" name="sort" value="1"/>        
                    </form>

                    <form>
                        @csrf
                        <input type="submit" class="dropdown-item" value="Time found (desc)"/>
                        <input type="hidden" name="sort" value="2"/>        
                    </form>
                </div>
                </div>
                <div class="card-header"><h1>Pets</h1></div>
                <div class="card-body" id="pets">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>name</th>
                                <th>color</th>
                                <th>found place</th>
                                <th>found time</th>
                                <th>description</th>
                                @auth
                                    @if(Gate::allows('isAdmin'))
                                        <th colspan="4">Actions</th>
                                    @else
                                        <th colspan="2">Actions</th>
                                    @endif
                                @endauth
                            </tr>
                        </thead>
                        <tbody> 
                            @foreach($items as $item)
                            @if($item['category'] == 'pet')
                            <tr>
                                <td>{{$item['name']}}</td>
                                <td>{{$item['color']}}</td>
                                <td>{{$item['place_found']}}</td>
                                <td>{{$item['found_time']}}</td>
                                <td>{{$item['description']}}</td>
                                @auth
                                    <td><a href="{{action('ItemController@show', $item['id'])}}" class="btn">Details</a></td>
                                    @if(Gate::allows('isAdmin'))
                                        <td><a href="{{action('ItemController@edit', $item['id'])}}" class="btn">Edit</a></td>
                                        <td>
                                            <form action="{{action('ItemController@destroy', $item['id'])}}"
                                            method="post"> @csrf
                                                <input name="_method" type="hidden" value="DELETE">
                                                <input name="page" type="hidden" value="0">
                                                <button class="btn btn-danger" type="submit"> Delete</button>
                                            </form>
                                        </td>
                                    @endif
                                    <td><a href="{{ action('RequestController@create', $item['id']) }}" class="btn
                                    btn-primary">Request</a></td>
                                @endauth
                            </tr>
                            @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-header" ><h1>Phone</h1></div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>name</th>
                                <th>color</th>
                                <th>found place</th>
                                <th>found time</th>
                                <th>description</th>
                                @auth
                                    @if(Gate::allows('isAdmin'))
                                        <th colspan="4">Actions</th>
                                    @else
                                        <th colspan="2">Actions</th>
                                    @endif
                                @endauth
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($items as $item)
                            @if($item['category'] == 'phone')
                            <tr>
                                <td>{{$item['name']}}</td>
                                <td>{{$item['color']}}</td>
                                <td>{{$item['place_found']}}</td>
                                <td>{{$item['found_time']}}</td>
                                <td>{{$item['description']}}</td>
                                @auth
                                    <td><a href="{{action('ItemController@show', $item['id'])}}" class="btn
                                    btn- primary">Details</a></td>
                                    @if(Gate::allows('isAdmin'))
                                        <td><a href="{{action('ItemController@edit', $item['id'])}}" class="btn">Edit</a></td>
                                        <td>
                                            <form action="{{action('ItemController@destroy', $item['id'])}}"
                                            method="post"> @csrf
                                                <input name="_method" type="hidden" value="DELETE">
                                                <button class="btn btn-danger" type="submit"> Delete</button>
                                            </form>
                                        </td>
                                    @endif
                                    <td><a href="{{ url('requests/create/'.$item['id']) }}" class="btn
                                    btn- warning">Request</a></td>
                                @endauth
                            </tr>
                            @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-header"><h1>Jewellery</h1></div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>name</th>
                                <th>color</th>
                                <th>found place</th>
                                <th>found time</th>
                                <th>description</th>
                                @auth
                                    @if(Gate::allows('isAdmin'))
                                        <th colspan="4">Actions</th>
                                    @else
                                        <th colspan="2">Actions</th>
                                    @endif
                                @endauth
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($items as $item)
                            @if($item['category'] == 'jewellery')
                            <tr>
                                <td>{{$item['name']}}</td>
                                <td>{{$item['color']}}</td>
                                <td>{{$item['place_found']}}</td>
                                <td>{{$item['found_time']}}</td>
                                <td>{{$item['description']}}</td>
                                @auth
                                    <td><a href="{{action('ItemController@show', $item['id'])}}" class="btn
                                    btn- primary">Details</a></td>
                                    @if(Gate::allows('isAdmin'))
                                        <td><a href="{{action('ItemController@edit', $item['id'])}}" class="btn">Edit</a></td>
                                        <td>
                                            <form action="{{action('ItemController@destroy', $item['id'])}}"
                                            method="post"> @csrf
                                                <input name="_method" type="hidden" value="DELETE">
                                                <button class="btn btn-danger" type="submit"> Delete</button>
                                            </form>
                                        </td>
                                    @endif
                                    <td><a href="{{ url('requests/create/'.$item['id']) }}" class="btn
                                    btn- warning">Request</a></td>
                                @endauth
                            </tr>
                            @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @guest
        <div style="position:relative; top:130px;"><h4>for more details about the items please sign up or login</h4></div>
        @endguest
    </div>
</div>
@endsection