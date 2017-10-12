<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Homework extends Model
{
    public function Subjects() {
        return $this->belongsTo('App\Subject');
    }
}
