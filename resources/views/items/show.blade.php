@extends('layouts.app')
@section('content')

<div class="container">
<div class="row justify-content-center">
<div class="col-md-8 ">
<div class="card">
<div class="card-header">Details</div>
<div class="card-body">
<table class="table table-striped" border="1" >
<tr> <td> <b>Item name </th> <td> {{$item['name']}}</td></tr>
<tr> <th>Item type </th> <td>{{$item->category}}</td></tr>
<tr> <th>Item color </th> <td>{{$item->color}}</td></tr>
<tr> <td>Place found </th> <td>{{$item->place_found}}</td></tr>
<tr> <td>found user </th> <td>{{$item->user_found}}</td></tr>
<tr> <td>Time found </th> <td>{{$item->found_time}}</td></tr>
<tr> <th>Notes </th> <td style="max-width:150px;" >{{$item->description}}</td></tr>

</table>
<table><tr>
<div class="owl-carousel owl-theme" style="display: block;width: auto;height: auto;">
    @if($images)
    @foreach ($images as $image)
       <div class="item" ><img src="{{ asset('storage/images/'.$image) }}" style="display: block;width: 100%;height: auto;"/></div>
    @endforeach
    @else
    <div class="item"><img src="{{ asset('storage/images/'.$item->image) }}" style="display: block;width: 100%;height: auto;"/></div>
    @endif
    </div>
</div>
<td><a href="{{route('items.index')}}" class="btn btn-primary" role="button">Back to the
list</a>
</td>
</tr></table>
</div>
</div>
</div>
</div>

</div>


@endsection

@section('scripts')
<script src="{{asset('OwlCarousel2-2.3.4/docs/assets/vendors/jquery.min.js')}}"></script>
    <script defer src="{{ asset('OwlCarousel2-2.3.4/dist/owl.carousel.min.js') }}"></script>
    <script type="text/javascript">
    $(document).ready(function(){
    $(".owl-carousel").owlCarousel({
        navigation : true, // Show next and prev buttons
        slideSpeed : 300,
        paginationSpeed : 400,
        singleItem:true
  });
  });
    </script>
@endsection

@section('styles')
    <link href="{{ asset('OwlCarousel2-2.3.4/dist/assets/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('OwlCarousel2-2.3.4/dist/assets/owl.theme.default.min.css') }}" rel="stylesheet">
@endsection