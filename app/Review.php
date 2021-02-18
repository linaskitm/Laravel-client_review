<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = ['name', 'spec', 'service', 'city', 'gender', 'image', 'ratio_id', 'user_id'];

    public function ratings(){

        return $this->hasMany(Rating::class);
    }
}
