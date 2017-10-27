@extends('templates.template')
@section('title', 'term list')
@section('header')
    @include('components.header')
    <nav aria-label="breadcrumb" role="navigation">
        <ol class="breadcrumb">
            <li class="breadcrumb-item" aria-current="page"><a href="/">Home</a></li>
            <li class="breadcrumb-item" aria-current="page"><a href="/year">Year</a></li>
            <li class="breadcrumb-item active" aria-current="page">Term</li>
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
            <h3>Term List</h3>
        </div>
        <div class="card-body">
            <table class="table text-center">
                    <thead class="thead-dark">
                        <tr>
                        <th><h3>Term</h3></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <a href="/term/1/subject" class="btn btn-info">1</a>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <a href="/term/2/subject" class="btn btn-info">2</a>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <a href="/term/3/subject" class="btn btn-info">Summer</a>
                            </td>
                        </tr>
                    </tbody>
            </table>
        </div>
    </div>
@endsection
