<?php

namespace App\Http\Controllers;
use App\Rating;
use Illuminate\Support\Facades\Auth;
use App\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function __construct(){

        $this->middleware('auth', ['except' => ['index']]);
    }
    public function index(){
        $reviews = Review::all();

        $ratio = Review::with('ratings')->get();

        $specArray =[];
        foreach ($reviews as $item){
            array_push($specArray, $item->spec);
        }
        $specArray = array_unique($specArray);

        $serviceArray = [];
        foreach ($reviews as $item){
            array_push($serviceArray, $item->service);
        }
        $serviceArray = array_unique($serviceArray);

        $cityArray = [];
        foreach ($reviews as $item){
            array_push($cityArray, $item->city);
        }
        $cityArray = array_unique($cityArray);

        $genderArray = [];
        foreach ($reviews as $item) {
            array_push($genderArray, $item->gender);
        }
        $genderArray = array_unique($genderArray);



        return view('reviews', compact('reviews', 'ratio', 'specArray', 'serviceArray', 'cityArray', 'genderArray'));
    }

    public function store(Request $request){
        $validateData = $request->validate([
            'name' => 'required',
            'spec' => 'required',
            'service'=> 'required',
            'city' => 'required',
            'gender' => 'required'
        ]);


        Review::create([
            'name' => request('name'),
            'spec' => request('spec'),
            'service' => request('service'),
            'city' => request('city'),
            'gender' => request('gender'),
            'user_id' => Auth::id()
        ]);

        return redirect('/home');
    }

    public function storeRating(){
        $reviews = Review::all();
        Rating::create([
           'rating'=>request('rating'),
            'review_id'=> request('review_id'),
           'user_id'=> Auth::id()

        ]);
        return redirect('/home');
    }


}
