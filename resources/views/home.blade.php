{{--  @extends('templates.template')
@section('title', 'home')
@section('content')
<div class="card">
  <h4 class="card-header">My Homework</h4>
  <div class="card-body">
    @for($i = 1; $i <= 4; $i++)
    <h3 class="card-title" style="color:#CC0000">Year {{$i}}</h3>
    <ul class="list-group list-group-flush">
        <li class="list-group-item">
            @for($j = 1; $j <= 3; $j++)
            <h4 class="card-title" style="color:#FF00FF">Term {{$j}}</h4>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">
                    <h5 class="card-title" style="color:#8A2BE2">Subject</h5>
                    <ul>
                        @foreach($collection[$i][$j] as $subjects)
                            @if(count($subjects) > 0)
                                @foreach($subjects as $subject)
                                    <li>{{$subject->name}} {{$subject->status}}</li>
                                @endforeach
                            @endif
                        @endforeach
                    </ul>
                </li>
            </ul>
            @endfor
        </li>
    </ul>
    @endfor
  </div>
  <div class="card-footer text-center">
    <a href="/year" class="btn btn-primary">START</a>
  </div>
</div>
@endsection  --}}
@extends('templates.template')
@section('title', 'Home')
@section('header')
    @include('components.header')
    <nav aria-label="breadcrumb" role="navigation">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Home</li>
        </ol>
    </nav>
@endsection
@section('content')
    <div>
        <a href="/year" class="btn btn-primary">Go </a>
    </div>
    <br>
    <div id="accordion" role="tablist">
        @for($i = 1; $i <= 4; $i++)
        <div class="card">
            <div class="card-header" role="tab">
                <h5 class="mb-0">
                <a data-toggle="collapse" href="#collapse{{$i}}" aria-expanded="true" aria-controls="collapse{{$i}}">
                    Year #{{$i}}
                </a>
                </h5>
            </div>
            <div id="collapse{{$i}}" class="collapse" role="tabpanel">
                <div class="card-body">
                    @for($j = 1; $j <= 3; $j++)
                    <div class="card">
                        <div class="card-header" role="tab">
                        <h5 class="mb-0">
                            <a data-toggle="collapse" href="#collapse{{$i}}{{$j}}" aria-expanded="true" aria-controls="collapse{{$i}}{{$j}}">
                                Term #{{$j}}
                            </a>
                        </h5>
                        </div>

                        <div id="collapse{{$i}}{{$j}}" class="collapse" role="tabpanel">
                            <div class="card-body">
                                @foreach($collection[$i][$j] as $subjects)
                                    @if(count($subjects)>0)
                                        <ul>
                                            @foreach($subjects as $subject)
                                                <li><h4>{{$subject->name}}</h4></li>
                                            @endforeach    
                                        </ul>
                                    @else
                                        <h4>.....Empty.....</h4>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @endfor
                </div>
            </div>
        </div>
        @endfor
    </div>
@endsection
