@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
    <form action="/store" method="post" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="form-group">
            <label for="name"></label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Name and Lastname">
        </div>
        <div class="form-group">
            <label for="spec"></label>
            <input type="text" class="form-control" id="spec" name="spec" placeholder="Spec">
        </div>
        <div class="form-group">
            <label for="service"></label>
            <input type="text" class="form-control" id="service" name="service" placeholder="Service">
        </div>
        <div class="form-group">
            <label for="city"></label>
            <input type="text" class="form-control" id="city" name="city" placeholder="City">
        </div>
        <select class="form-select form-select-sm form-control" name="gender_id" aria-label=".form-select-sm example">
            <option selected>Open this select menu</option>
            {{$genders = \App\Gender::all()}}
            @foreach($genders as $gender)
            <option value={{$gender->id}}>{{$gender->gender}}</option>
            @endforeach
        </select>


        <div class="form-group">
            <label for="image"></label>
            <input type="file" class="btn" id="image" name="image">
        </div>
        <div class="form-group d-flex justify-content-center m-5">
            <button type="submit" class="btn btn-secondary rounded">Add Service</button>
        </div>
    </form>

    <form action="/storegender" method="post">
        {{csrf_field()}}
        <select class="form-select form-select-sm form-control"  name="gender" aria-label=".form-select-sm example">
            <option selected>Open this select menu</option>
            <option value="male">Male</option>
            <option value="female">Female</option>
            <option value="other">Other</option>
        </select>
        <div class="form-group d-flex justify-content-center m-5">
            <button type="submit" class="btn btn-secondary rounded">Add Gender</button>
        </div>
    </form>

</div>
@endsection
