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

                <li class="list-group-item "><a class="text-muted" href="/getbyrate/{{$finalrate->id}}">{{$finalrate->finalrate}}</a></li>

            @endforeach

        </ul>
    </div>

</div>
