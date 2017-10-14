<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Subject;

use App\Homework;

class HomeworkController extends Controller
{
    public function onHomeworkList($year, $term, $id) {
        $homeworks = Subject::find($id)->homeworks;
        $subjectName = Subject::find($id)->name;
        return view('homeworkList', compact('homeworks', 'subjectName', 'year', 'term', 'id'));
    }
    private function convertStatus($status) {
        if($status == 0) {
            return "none";
        }
        if($status == 1) {
            return "doing";
        }
        if($status == 2) {
            return "finished";
        }
        return "notfinish";
    }
    public function addHomework(Request $request, $subjectId) {
        $status = $this->convertStatus($request['status']);
        Homework::create([
            'name'=>$request['nameHomework'],
            'order_date'=>$request['orderDate'],
            'sent_date'=>$request['sentDate'],
            'status'=>$status,
            'subject_id'=>$subjectId
        ]);
        return back();
    }
    public function editHomework(Request $request, $id) {
        $status = $this->convertStatus($request['editStatus']);
        Homework::find($id)->update([
            'name'=>$request['editNameHomework'],
            'order_date'=>$request['editOrderDate'],
            'sent_date'=>$request['editSentDate'],
            'status'=>$status
        ]);
        return back();
    }
    public function deleteHomework($id) {
        Homework::find($id)->delete();
        return back();
    }
}
