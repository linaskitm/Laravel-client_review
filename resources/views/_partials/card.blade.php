@foreach($reviews as $review)

    <div class="row justify-content-center pt-5 " >
        <div class="col-md-8">
            <div class="row justify-content-center bg-white">
                <div class="col-2">
                    <img src="{{asset($review->image)}}">
                </div>
                <div class="col-6">
                    <p class="m-0">Vardas: {{$review->name}} </p>
                    <p class="m-0">Spec: {{$review->spec}}</p>
                    <p class="m-0">Servisas: {{$review->service}}</p>
                    <p class="m-0">Miestas: {{$review->city}}</p>
                </div>
                <div class="col">
                    <p>Ratings:

                        @foreach($ratio as $item)
                            @if($review->id == $item->id)

                                {{number_format($item->ratings()->avg('rating'), 1) }}

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
                        <form action="/storeratings" method="post">
                            {{csrf_field()}}
                            <div class="form-group wrapper">
                                <input class="input" type="text" name="review_id" value="{{$review->id}}" hidden>
                                <input class="input" type="radio" id="r1" name="rating" value="1">
                                <label for="r1">1</label>
                                <input class="input" type="radio" id="r2" name="rating" value="2">
                                <label for="r2">2</label>
                                <input class="input" type="radio" id="r3" name="rating" value="3">
                                <label for="r3">3</label>
                                <input class="input" type="radio" id="r4" name="rating" value="4">
                                <label for="r4">4</label>
                                <input class="input" type="radio" id="r5" name="rating" value="5">
                                <label for="r5">5</label>
                                <button type="submit" class="btn  btn-success btn-sm">Rate</button>
                            </div>

                        </form>
                        <button class="btn  btn-danger btn-sm"><a href="/delete/{{$review->id}}"> Delete</a></button>
                    @endif
                </div>

            </div>
        </div>
    </div>
@endforeach
