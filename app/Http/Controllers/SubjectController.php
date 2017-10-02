<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\YearTerm;

class SubjectController extends Controller
{
    public function onSubjectsList($term) {
        session()->put('term', $term);
        $year = session()->get('year');
        $subjects = YearTerm::where('year_id', $year)
            ->where('term_id', $term)
            ->first()
            ->subjects??[];
        return view('subjectsList', compact('subjects'));
    }
}
