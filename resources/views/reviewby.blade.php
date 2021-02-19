@extends('layouts.app')

@section('content')
    <div class="container">
        {{--           search bar           --}}
        @include("_partials/searchbar")

        {{--           List displayed from databse           --}}
        @include("_partials/card")

    </div>
@endsection
