<?php

namespace App\Http\Controllers;
use App\Finalrate;
use App\Gender;
use App\Rating;
use App\User;
use Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function __construct(){

        $this->middleware('auth', ['except' => ['index', 'searchBar', 'displayByRate']]);
    }
    public function index(){
        $reviews = Review::all();

        $ratio = Review::with('ratings')->get();

        $genders = Gender::all();
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

        return view('reviews', compact('reviews', 'ratio', 'specArray', 'serviceArray', 'cityArray', 'genders'));
    }



    public function store(Request $request){
        $validateData = $request->validate([
            'name' => 'required',
            'spec' => 'required',
            'service'=> 'required',
            'city' => 'required',
            'gender_id' => 'required'
//            'image'=>'mimes:jpeg, jpg, png, gif|required|max:10000'
        ]);
        $path = $request->file('image')->store('public/images');
        $filename = str_replace('public/', "", $path);

        Review::create([
            'name' => request('name'),
            'spec' => request('spec'),
            'service' => request('service'),
            'city' => request('city'),
            'gender_id' => request('gender_id'),
            'image' => $filename,
            'user_id' => Auth::id()
        ]);
        return redirect('/');
    }
    public function delete(Review $review){
        If(Gate::allows('delete', $review)){
            $review->delete();
        }

        return redirect('/');

    }

    public function storeRating(){

                    Rating::create([
                        'rating'=>request('rating'),
                        'review_id'=> request('review_id'),
                        'user_id'=> Auth::id()
                    ]);

        return redirect('/');
    }


    public function storeGender(){
        Gender::create([
           'gender' => request('gender'),
            'user_id'=> Auth::id()
        ]);

        return redirect('/home');
    }

    public function displayByRate(){
        $reviews = Review::whereHas('ratings', function ($query) {
            return $query->where('rating', request('rating'));
        })->get();

        $ratio = Review::with('ratings')->get();
        $reviewsForNav = Review::all();
        $specArray =[];
        foreach ($reviewsForNav as $item){
            array_push($specArray, $item->spec);
        }
        $specArray = array_unique($specArray);

        $serviceArray = [];
        foreach ($reviewsForNav as $item){
            array_push($serviceArray, $item->service);
        }
        $serviceArray = array_unique($serviceArray);

        $cityArray = [];
        foreach ($reviewsForNav as $item){
            array_push($cityArray, $item->city);
        }
        $cityArray = array_unique($cityArray);

        $genders = Gender::all();

        return view('reviewby', compact('reviews', 'ratio', 'specArray', 'serviceArray', 'cityArray', 'genders'));
    }



    public function searchBar(Request $request){
        $reviews = Review::where('name', 'LIKE', '%'.request('search').'%')
            ->where('city', 'LIKE', '%'.request('city').'%')
            ->where('service', 'LIKE' ,'%'.request('service').'%' )
            ->where('spec', 'LIKE' ,'%'.request('spec').'%' )
            ->where('gender_id', 'LIKE' ,'%'.request('gender').'%' )
           ->get();
//


        $ratio = Review::with('ratings')->get();


        $reviewsForNav = Review::all();
        $specArray =[];
        foreach ($reviewsForNav as $item){
            array_push($specArray, $item->spec);
        }
        $specArray = array_unique($specArray);

        $serviceArray = [];
        foreach ($reviewsForNav as $item){
            array_push($serviceArray, $item->service);
        }
        $serviceArray = array_unique($serviceArray);

        $cityArray = [];
        foreach ($reviewsForNav as $item){
            array_push($cityArray, $item->city);
        }
        $cityArray = array_unique($cityArray);

        $genders = Gender::all();

        return view('reviewby', compact('reviews', 'ratio', 'specArray', 'serviceArray', 'cityArray', 'genders'));
    }


}
