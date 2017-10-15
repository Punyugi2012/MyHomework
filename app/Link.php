<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    protected $fillable = ['name', 'link_url', 'homework_id'];
    public function homework() {
        return $this->belongsTo('App\Homework');
    }
}
