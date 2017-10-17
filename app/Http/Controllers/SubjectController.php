<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\YearTerm;

use App\Subject;

use App\YearTermSubject;

class SubjectController extends Controller
{
    public function onSubjectsList($term) {
        session()->put('term', $term);
        $year = session()->get('year');
        $subjects = YearTerm::where('year_id', $year)
            ->where('term_id', $term)
            ->first()
            ->subjects??[];
        return view('subjectList', compact('subjects', 'year', 'term'));
    }
    private function convertStatus($status) {
        if($status == 1) {
            return 'studying';
        }
        elseif($status == 2) {
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
            'begin_date'=>$request['beginDate'],
            'professor_name'=>$request['professorName']??'',
            'professor_web'=>$request['professorWeb']??'',
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
    public function editSubject(Request $request, $id) {
        $status = $request['edit-subjectStatus'];
        $status = $this->convertStatus($status);
        Subject::find($id)->update([
            'subject_code'=>$request['edit-subjectCode'],
            'name'=>$request['edit-subjectName'],
            'status'=>$status,
            'begin_date'=>$request['edit-beginDate'],
            'professor_name'=>$request['edit-professorName']??'',
            'professor_web'=>$request['edit-professorWeb']??'',
        ]);
        return back();
    }
}
