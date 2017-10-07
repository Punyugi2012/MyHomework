<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class YearTermSubject extends Model
{
    protected $table = 'yearterm_subject';
    protected $fillable = ['year_term_id', 'subject_id'];
    public $timestamps = false;
}
