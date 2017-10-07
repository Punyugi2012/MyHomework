<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $fillable = ['subject_code', 'name', 'status', 'subject_date', 'professor_name', 'professor_web'];
}
