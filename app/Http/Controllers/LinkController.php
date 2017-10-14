<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Homework;

class LinkController extends Controller
{
    public function onLinkList($homeworkId) {
       $links = Homework::find($homeworkId)->links;
       return $links;
    }
}
