@extends('layouts.app')

@section('content')

<div class="container">

    {{--           search bar with dropdowns           --}}
    <form action="/search">
        <div class="row">
            <div class="col-md-2">
                <input class="form-control form-control-sm" type="search" name="search" value="">
            </div>

            <div class="col-md-2 col-2">
                <select name="spec" class="form-control form-control-sm" value="">
                    <option selected disabled>Spec</option>
                    @foreach($specArray as $item)
                        <option value="{{$item}}">{{$item}}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-2 col-2">
                <select name="service" class="form-control form-control-sm" value="">
                    <option selected disabled>Service</option>
                    @foreach($serviceArray as $item)
                        <option value="{{$item}}">{{$item}}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-2 col-2">
                <select name="city" class="form-control form-control-sm" value="">
                    <option selected disabled>City</option>
                    @foreach($cityArray as $item)
                        <option value="{{$item}}">{{$item}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2 col-2">
                <select name="gender" class="form-control form-control-sm" value="">
                    <option selected disabled>Gender</option>
                    @foreach($genders as $item)
                        <option value="{{$item->id}}">{{$item->gender}}</option>
                    @endforeach
                    >
                </select>
            </div>


            <div class="col-md-2 col-2">
                <button type="submit" class="w-100 btn btn-sm bg-blue">Search</button>
            </div>
        </div>
    </form>


        <div class="row pt-2">
            <div class="col-md-1 col-1">
               <ul class="list-group">
                        @foreach($finalrates as $finalrate)

                               <li class="list-group-item"><a href="/getbyrate/{{$finalrate->id}}">{{$finalrate->finalrate}}</a></li>

                        @endforeach

                    </ul>
            </div>

        </div>


{{--           List displayed from databse           --}}
    @foreach($reviews as $review)

    <div class="row justify-content-center pt-5">
        <div class="col-md-8">
            <div class="row justify-content-center">
                <div class="col-2">
                    <img src="{{asset($review->image)}}">
                </div>
                <div class="col-6">
                    <p>Vardas: {{$review->name}} </p>
                    <p>Spec: {{$review->spec}}</p>
                    <p>Servisas: {{$review->service}}</p>
                    <p>Miestas: {{$review->city}}</p>
                </div>
                <div class="col">
                    <p>Ratings:

                    @foreach($ratio as $item)
                            @if($review->id == $item->id)
                        {{$item->ratings()->avg('rating')}}
                            @endif
                        @endforeach
                    </p>
                        <form action="/storefinalrate" method="post">
                            {{csrf_field()}}
                            @foreach($ratio as $item)
                                @if($review->id == $item->id)
                                    <input type="number" value="{{$review->id}}" name="finalreview">
                                    <input type="number" value="{{$item->ratings()->avg('rating')}}" name="finalrate">
                                @endif
                            @endforeach
                                <button type="submit" class="btn btn-secondary rounded">Add Rating to database</button>
                        </form>


                    @if(Auth::check())
                    <form action="/storeratings" method="post">
                        {{csrf_field()}}
                        <input type="number" class="form-control" value="{{$review->id}}" id="review_id" name="review_id" placeholder="{{$review->id}}">
                    <select class="form-select"  name="rating"multiple aria-label="multiple select example">
                        <option selected>Open this select menu</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                        <option value="4">Four</option>
                        <option value="5">Five</option>
                    </select>
                            <button type="submit" class="btn btn-secondary rounded">Add Rating</button>
                    </form>
                    @endif
                </div>

            </div>
        </div>
    </div>
    @endforeach
</div>

@endsection
