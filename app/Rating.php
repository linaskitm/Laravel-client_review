<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    protected $fillable = ['rating', 'review_id', 'user_id'];

    public function rewiewsByRate(){
        return $this->belongsTo(Review::class);
    }

}
