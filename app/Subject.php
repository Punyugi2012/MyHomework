<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $fillable = ['subject_code', 'name', 'status', 'begin_date', 'professor_name', 'professor_web'];

    public function homeworks() {
        return $this->hasMany('App\Homework');
    }
    public function getNumOfHomework() {
        $homeworks =  $this->homeworks;
        $count = 0;
        foreach($homeworks as $homework) {
            if(
            $homework->status == 'none' || 
            $homework->status == 'doing' ||
            $homework->status == 'notfinish'
            ) {
                $count++;
            }
        }
        return $count;
    }
}
