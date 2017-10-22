<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Subject;

use App\Homework;

use App\YearTerm;

class MyHomeworkController extends Controller
{
    public function onHome() {
        $collection = array(
            1 => array(
                1 => array(),
                2 => array(),
                3 => array()
            ),
            2 => array(
                1 => array(),
                2 => array(),
                3 => array()
            ),
            3 => array(
                1 => array(),
                2 => array(),
                3 => array()
            ),
            4 => array(
                1 => array(),
                2 => array(),
                3 => array()
            )
        );
        for($year = 1; $year <= 4; $year++) {
            for($term = 1; $term <= 3; $term++) {
                array_push($collection[$year][$term],YearTerm::where('year_id', $year)->where('term_id', $term)->first()->subjects);
            }
        }
        return view('home', compact('collection'));
    }
    public function onYearslist() {
        return view('yearsList');
    }
    public function onTermsList($year) {
        session()->put('year', $year);
        return view('termsList', ['year'=>$year]);
    }
}
