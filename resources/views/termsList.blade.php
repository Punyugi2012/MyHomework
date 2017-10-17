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
    <div style="margin-top:20px">
        <h1 style="display:inline;color:#0000FF">
            <a href="/year">Year</a>:{{$year}}
        </h1>
    </div>
    <div align="center" style="margin-top:50px">
        <div class="card">
            <h1>Terms</h1>
        </div>
        <div>
            <a href="/term/1/subject" class="btn btn-primary">
                <h1>1</h1>
            </a>
        </div>
        <br>
         <div>
            <a href="/term/2/subject" class="btn btn-primary">
                <h1>2</h1>
            </a>
        </div>
        <br>
         <div>
            <a href="/term/3/subject" class="btn btn-primary">
                <h1>Summer</h1>
            </a>
        </div>
    </div>
@endsection