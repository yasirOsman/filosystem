@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10 ">
            <div class="card" >
                
                
                <div class="card-header">
                <div style="margin-left: 780px">
                <button class="btn btn-secondary dropdown-toggle"  type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                 Sort by
                </button>
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
                    <form>
                        @csrf
                        <input type="submit" class="dropdown-item" value="Category"/>
                        <input type="hidden" name="sort" value="3"/>        
                    </form>
                </div>
                </div>
                <h1>Items</h1></div>
                <div class="card-body" id="pets">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>name</th>
                                <th>category</th>
                                <th>color</th>
                                <th>Date and time found</th>
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
                            
                            <tr>
                                <td>{{$item['name']}}</td>
                                <td>{{$item['category']}}</td>
                                <td>{{$item['color']}}</td>
                                <td>{{$item['found_time']}}</td>
                                @auth
                                    <td><a href="{{action('ItemController@show', $item['id'])}}" class="btn btn-info">Details</a></td>
                                    @if(Gate::allows('isAdmin'))
                                        <td><a href="{{action('ItemController@edit', $item['id'])}}" class="btn btn-warning">Edit</a></td>
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