@extends('layouts.app')

@section('content')

<div class="container">

    <div class="row justify-content-center">
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                    Spec
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                    @foreach($specArray as $spec)
                        <li><a class="dropdown-item" href="#">{{$spec}}</a></li>
                    @endforeach
                </ul>
            </div>
        <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                Service
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                @foreach($serviceArray as $service)
                    <li><a class="dropdown-item" href="#">{{$service}}</a></li>
                @endforeach
            </ul>
        </div>
        <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                City
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                @foreach($cityArray as $city)
                    <li><a class="dropdown-item" href="#">{{$city}}</a></li>
                @endforeach
            </ul>
        </div>
        <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                Gender
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">

                    @foreach($genderArray as $gender)

                    <li><a class="dropdown-item" href="#">{{$gender}}</a></li>


                @endforeach
            </ul>
        </div>
        <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                Ratings
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                <li><a class="dropdown-item" href="#">Action</a></li>
                <li><a class="dropdown-item" href="#">Another action</a></li>
                <li><a class="dropdown-item" href="#">Something else here</a></li>
            </ul>
        </div>
    </div>



    @foreach($reviews as $review)
    <div class="row justify-content-center pt-5">
        <div class="col-md-8">
            <div class="row justify-content-center">
                <div class="col-2">Image</div>
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
