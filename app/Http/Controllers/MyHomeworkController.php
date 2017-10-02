<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MyHomeworkController extends Controller
{
    public function onYearslist() {
        return view('yearsList');
    }
    public function onTermsList($year) {
        session()->put('year', $year);
        return view('termsList');
    }
}
