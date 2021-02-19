@foreach($reviews as $review)

    <div class="row justify-content-center pt-5 " >
        <div class="col-md-8">
            <div class="row justify-content-center bg-white">
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


                                    @for ($i = 0; $i < 5; $i++)
                                        @if (floor($item->ratings()->avg('rating')) - $i >= 1)
                                            {{--Full Start--}}
                                            <i class="fas fa-star text-warning"> </i>
                                        @elseif ($item->ratings()->avg('rating') - $i > 0)
                                            {{--Half Start--}}
                                            <i class="fas fa-star-half-alt text-warning"> </i>
                                        @else
                                            {{--Empty Start--}}
                                            <i class="far fa-star text-warning"> </i>
                                        @endif
                                    @endfor
                                ({{$item->ratings()->get()->count()}})


                            @endif
                        @endforeach
                    </p>
                    @if(Auth::check())
                        <form action="/storefinalrate" method="post">
                            {{csrf_field()}}
                            @foreach($ratio as $item)
                                @if($review->id == $item->id)
                                    <input type="checkbox" disabled hidden value="{{$review->id}}" name="finalreview">
                                    <input type="checkbox" disabled hidden value="{{$item->ratings()->avg('rating')}}" name="finalrate">
                                @endif
                            @endforeach
                            <button type="submit" class="btn btn-secondary rounded">Add rate to db</button>
                        </form>

                        <form action="/storeratings" method="post">
                            {{csrf_field()}}
                            <input type="checkbox" disabled hidden value="{{$review->id}}" id="review_id" name="review_id" placeholder="{{$review->id}}">
                            <select class="form-select"  name="rating"multiple aria-label="multiple select example">
                                <option selected>Rate this</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                            <button type="submit" class="btn btn-secondary rounded">Rate</button>
                        </form>
                    @endif
                </div>

            </div>
        </div>
    </div>
@endforeach
