<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Homework;
use App\Subject;
use App\Link;

class LinkController extends Controller
{
    public function onLinkList($homeworkId) {
        $year = session()->get('year');
        $term = session()->get('term');
        $subjectName = Subject::find(session()->get('subject'))->name;
        $links = Homework::find($homeworkId)->links;
        $homeworkName = Homework::find($homeworkId)->name;
        return view('linkList', compact('year', 'term', 'subjectName', 'homeworkName', 'links'));
    }
    public function addLink(Request $request) {
        $homeworkId = session()->get('homework');
        Link::create([
            'name'=>$request['nameUrl'],
            'link_url'=>$request['url'],
            'homework_id'=>$homeworkId
        ]);
        return back();
    }
    public function editLink(Request $request, $id) {
        Link::find($id)->update([
            'name'=>$request['editLinkName'],
            'link_url'=>$request['editUrl'],
        ]);
        return back();
    }
    public function deleteLink($id) {
        Link::find($id)->delete();
        return back();
    }
}
