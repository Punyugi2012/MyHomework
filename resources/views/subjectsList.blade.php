@extends('templates.template')
@section('title', 'subjects list')
@section('header')
    @include('components.header', ['logo'=>'SUBJECTS LIST'])
@endsection
@section('content')
    <style>
        div.card {
            margin-top:50px;
            width:700px;
        }
        div.alert {
            margin-top:300px;
        }
    </style>
    @if(count($subjects) == 0)
        <div class="alert alert-warning">
           <h1 class="text-center">No subjects</h1>
        </div>
    @endif
    @foreach($subjects as $subject)
        <div align="center">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">{{$subject->name}}</h4>
                    <p>{{$subject->web_professor}}</p>
                    <a href="{{$subject->professor_web}}" target="_blank">เว็ปจารย์</a>
                </div>
                <div class="card-footer text-muted">
                </div>
            </div>
        </div>
    @endforeach
@endsection
