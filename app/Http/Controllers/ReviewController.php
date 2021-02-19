<?php

namespace App\Http\Controllers;
use App\Finalrate;
use App\Gender;
use App\Rating;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function __construct(){

        $this->middleware('auth', ['except' => ['index', 'searchBar', 'getByRate']]);
    }
    public function index(){
        $reviews = Review::all();
        foreach ($reviews as $item){
//            dd($item->id);
        }
        $rates = Rating::with('rewiewsByRate')->get();
//        dd($rates);

        foreach ($rates as $item){
            foreach ($reviews as $item2){
                if($item->review_id == $item2->id){
                    $item->rating += $item->rating;
                }
//                dd($item->rating);
            }
        }

        $ratio = Review::with('ratings')->get();
        foreach ($ratio as $item){
            $item->ratings()->get('rating');
            foreach ($item->ratings()->get('rating') as $i){
//              dd($i);
            }
        }

        $genders = Gender::all();
        $finalrates = Finalrate::all();

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

        return view('reviews', compact('reviews', 'ratio', 'specArray', 'serviceArray', 'cityArray', 'genders', 'finalrates'));
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


    public function storeRating(){
        Rating::create([
           'rating'=>request('rating'),
            'review_id'=> request('review_id'),
           'user_id'=> Auth::id()
        ]);
        return redirect('/');
    }
    public function storeFinalRate(){
        Finalrate::create([
            'finalrate'=>request('finalrate'),
            'finalreview'=>request('finalreview')
        ]);
        return redirect('/');
    }
    public function getByRate(Finalrate $finalrate){
            $reviews = DB::table('finalrates')
                ->join('reviews', 'finalrates.finalreview', '=', 'reviews.id')
                ->select('reviews.id', 'reviews.name', 'reviews.spec', 'reviews.service', 'reviews.city','reviews.image', 'finalrates.finalrate')
                ->where('finalrates.finalreview', $finalrate->finalreview)
                ->get();
//            dd($reviews);
        $ratio = Review::with('ratings')->get();
        $finalrates = Finalrate::all();

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


        return view('reviewbyfinal', compact('reviews', 'ratio', 'specArray', 'serviceArray', 'cityArray', 'genders', 'finalrates'));
    }

    public function storeGender(){
        Gender::create([
           'gender' => request('gender'),
            'user_id'=> Auth::id()
        ]);

        return redirect('/home');
    }

    public function searchBar(Request $request){
        $reviews = Review::where('name', 'LIKE', '%'.request('search').'%')
            ->where('city', 'LIKE', '%'.request('city').'%')
            ->where('service', 'LIKE' ,'%'.request('service').'%' )
            ->where('spec', 'LIKE' ,'%'.request('spec').'%' )
            ->where('gender_id', 'LIKE' ,'%'.request('gender').'%' )->get();
//


        $ratio = Review::with('ratings')->get();
        $finalrates = Finalrate::all();

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

        return view('reviewby', compact('reviews', 'ratio', 'specArray', 'serviceArray', 'cityArray', 'genders', 'finalrates'));
    }


}
