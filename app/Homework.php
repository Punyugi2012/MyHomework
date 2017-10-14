<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Homework extends Model
{
    protected $fillable = ['name', 'order_date', 'sent_date', 'status', 'subject_id'];
    public function subject() {
        return $this->belongsTo('App\Subject');
    }
    public function links() {
        return $this->hasMany('App\Link');
    }
}
