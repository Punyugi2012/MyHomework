<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    public function homework() {
        return $this->belongsTo('App\Homework');
    }
}
