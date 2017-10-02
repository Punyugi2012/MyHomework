<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class YearTerm extends Model
{
    protected $table = "year_term";
    public function subjects() {
        return $this->belongsToMany('App\Subject', 'yearterm_subject', 'year_term_id', 'subject_id');
    }
}
