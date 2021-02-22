<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Finalrate extends Model
{
    protected $fillable = ['finalrate', 'review_id'];

    public function reviews(){

        return $this->belongsTo(Review::class);
    }
}
