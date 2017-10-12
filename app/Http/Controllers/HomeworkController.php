<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Subject;

class HomeworkController extends Controller
{
    public function onHomeworkList($year, $term, $id) {
        $homeworks = Subject::find($id)->homeworks;
        return view('homeworkList', compact('homeworks'));
    }
}
