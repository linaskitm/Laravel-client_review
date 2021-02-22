<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    protected $fillable = ['rating', 'review_id', 'user_id'];

    public function reviewsByRate(){

        return $this->belongsTo(Review::class, 'review_id');
    }

}
