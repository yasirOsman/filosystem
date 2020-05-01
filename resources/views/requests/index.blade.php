@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 ">
            <div class="card">
                <div class="card-header"><h1>Requests</h1></div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Item id</th>
                                <th>Request reason</th>
                                <th>User id</th>
                                <th colspan="3">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($requests as $request)
                            <tr>
                                <td>{{$request['item_id']}}</td>
                                <td>{{$request['reason']}}</td>
                                <td>{{$request['user_id']}}</td>
                                <td><a href="{{action('ItemController@show', $request['item_id'])}}" class="btn">View item details</a></td>
                                <td>
                                    <form action="{{action('ItemController@destroy', $request['id'])}}"
                                    method="post"> @csrf
                                    <input name="_method" type="hidden" value="DELETE">
                                    <input name="page" type="hidden" value="1">
                                    <button class="btn btn-success" type="submit">Approve</button>
                                    </form>
                                </td>
                                <td>
                                    <form action="{{action('RequestController@destroy', $request['id'])}}"
                                    method="post"> @csrf
                                    <input name="_method" type="hidden" value="DELETE">
                                    <button class="btn btn-danger" type="submit"> Deny</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection