@extends('templates.template')
@section('title', 'terms list')
@section('header')
     @include('components.header', ['logo'=>'TERMS LIST'])
@endsection
@section('content')
    <style>
        div.card {
            width:200px;
            margin-bottom:20px;
        }
        a {
            width:200px;
            height:100px;
            padding-top:20px!important;
        }
    </style>
    <div style="position: absolute">
        <h1>Year: {{$year}}</h1>
    </div>
    <div align="center" style="margin-top:50px">
        <div class="card">
            <h1>Terms</h1>
        </div>
        <div>
            <a href="/year/{{$year}}/term/1/subjects" class="btn btn-primary">
                <h1>1</h1>
            </a>
        </div>
        <br>
         <div>
            <a href="/year/{{$year}}/term/2/subjects" class="btn btn-primary">
                <h1>2</h1>
            </a>
        </div>
        <br>
         <div>
            <a href="/year/{{$year}}/term/3/subjects" class="btn btn-primary">
                <h1>Summer</h1>
            </a>
        </div>
    </div>
@endsection