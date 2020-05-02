@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 ">
            <div class="card">
                <div class="card-header">Details</div>
                <div class="card-body">
                    <table class="table table-striped" border="2" >
                        <tr> <td> <b>Item name </th> <td> {{$item['name']}}</td></tr>
                        <tr> <th>Item type </th> <td>{{$item->category}}</td></tr>
                        <tr> <th>Item color </th> <td>{{$item->color}}</td></tr>
                        <tr> <td><b>Place found </th> <td>{{$item->place_found}}</td></tr>
                        <tr> <td><b>found user </th> <td>{{$item->user_found}}</td></tr>
                        <tr> <td><b>Date and time found </th> <td>{{$item->found_time}}</td></tr>
                        <tr> <th>Notes </th> <td style="max-width:150px;" >{{$item->description}}</td></tr>
                    </table>
                    <table>
                        <tr>
                        @if($images)
                            <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                            @foreach ($images as $image)
                            <div class="carousel-item {{ $loop->first ? 'active' : '' }}" ><img src="{{ $image }}"   style="display: block;width: 100%;height: 100%;"/></div>
                            @endforeach
                            </div>
                            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                            </div>
                        @else
                            <div class="item"><img src="{{ $image }}" style="display: block;width: 100%;height: auto;"/></div>
                        @endif
                        </div>
                            <td><a href="{{route('items.index')}}" class="btn btn-primary" role="button">Back to the
                            list</a>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
