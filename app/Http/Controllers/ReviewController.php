<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function __construct(){

        $this->middleware('auth');
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


}
