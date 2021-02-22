<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = ['name', 'spec', 'service', 'city', 'gender_id', 'image', 'ratio_id', 'user_id'];

    public function ratings(){

        return $this->hasMany(Rating::class, 'review_id');
    }

    public function finalratings(){

        return $this->hasMany(Finalrate::class);
    }
}
