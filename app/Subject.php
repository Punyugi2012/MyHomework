<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $fillable = ['subject_code', 'name', 'status', 'begin_date', 'professor_name', 'professor_web'];

    public function homeworks() {
        return $this->hasMany('App\Homework');
    }
}
