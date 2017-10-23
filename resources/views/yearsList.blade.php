@extends('templates.template')
@section('title', 'year list')
@section('header')
    @include('components.header')
    <nav aria-label="breadcrumb" role="navigation">
        <ol class="breadcrumb">
            <li class="breadcrumb-item" aria-current="page"><a href="/">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Year</li>
        </ol>
    </nav>
@endsection
@section('content')
    <style>
        .card-body a {
            width:50%;
            height:60px!important;
            font-size:30px;
        }
    </style>
    <div class="card">
        <div class="card-header">
            <h3>Year List</h3>
        </div>
    <div class="card-body">
       <table class="table text-center">
            <thead class="thead-dark">
                <tr>
                   <th><h3>Year</h3></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <a href="/year/1/term" class="btn btn-info">1</a>
                    </td>
                </tr>
                <tr>
                     <td>
                        <a href="/year/2/term" class="btn btn-info">2</a>
                    </td>
                </tr>
                <tr>
                     <td>
                        <a href="/year/3/term" class="btn btn-info">3</a>
                    </td>
                </tr>
                <tr>
                     <td>
                        <a href="/year/4/term" class="btn btn-info">4</a>
                    </td>
                </tr>
            </tbody>
       </table>
    </div>
    </div>
@endsection
