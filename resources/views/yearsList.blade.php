@extends('templates.template')
@section('title', 'year list')
@section('header')
     @include('components.header', ['logo'=>'YEARS LIST'])
@endsection
@section('content')
    <style>
        body:nth-child(1) {
            margin-top:50px;
        }
        div:nth-child(1) {
            width:200px;
        }
        div:nth-child(2) {
            margin-top:50px;
        }
        a {
            width:200px;
            height:100px;
            padding-top:20px!important;
        }
    </style>
    <div align="center">
        <div class="card">
            <h1>Years</h1>
        </div>
        <div>
            <a href="/yearslist/year/1/termslist" class="btn btn-info">
                <h1>1</h1>
            </a>
        </div>
        <br>
         <div>
            <a href="/yearslist/year/2/termslist" class="btn btn-info">
                <h1>2</h1>
            </a>
        </div>
        <br>
         <div>
            <a href="/yearslist/year/3/termslist" class="btn btn-info">
                <h1>3</h1>
            </a>
        </div>
        <br>
         <div>
            <a href="/yearslist/year/4/termslist" class="btn btn-info">
                <h1>4</h1>
            </a>
        </div>
    </div>
@endsection