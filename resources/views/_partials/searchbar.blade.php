<form action="/search">
    <div class="row">
        <div class="col-md-2">
            <input class="form-control form-control-sm" type="search" name="search" value="" placeholder="Search">
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
            <button type="submit" class="btn btn-outline-secondary btn-sm">Search</button>
        </div>
    </div>
</form>
<form action="/displayrate">
    <div class="row pt-2" >
    <div class="col-md-2 col-2">
        <select name="rating" class="form-control form-control-sm">
            <option value="" selected disabled>Select by ratings</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
        </select>

    </div>
        <div class="col-md-2 col-2">
            <button type="submit" class="btn btn-outline-secondary btn-sm ">Get by rate</button>
        </div>
    </div>
</form>



