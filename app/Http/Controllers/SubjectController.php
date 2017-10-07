<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\YearTerm;

use App\Subject;

use App\YearTermSubject;

class SubjectController extends Controller
{
    public function onSubjectsList($year, $term) {
        session()->put('term', $term);
        $year = session()->get('year');
        $subjects = YearTerm::where('year_id', $year)
            ->where('term_id', $term)
            ->first()
            ->subjects??[];
        return view('subjectsList', compact('subjects'));
    }
    private function convertStatus($id) {
        if($id == 1) {
            return 'studying';
        }
        elseif($id == 2) {
            return  'passed';
        }
        return 'notpass';
    }
    public function addSubject(Request $request) {
        $status = $request['subjectStatus'];
        $status = $this->convertStatus($status);
        Subject::create([
            'subject_code'=>$request['subjectCode'],
            'name'=>$request['subjectName'],
            'status'=>$status,
            'subject_date'=>$request['subjectDate'],
            'professor_name'=>$request['professorName']??'',
            'professor_web'=>$request['professorWeb']??'#',
        ]);
        $year = session()->get('year');
        $term = session()->get('term');
        YearTermSubject::create([
            'year_term_id'=>YearTerm::where('year_id', $year)->where('term_id', $term)->first()->id,
            'subject_id'=>Subject::all()->last()->id,
        ]);
        return back();
    }
    public function deleteSubject($id) {
        $subject = Subject::find($id);
        $subject->delete();
        return back();
    }
}
