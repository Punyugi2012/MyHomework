@extends('templates.template')
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
@endsection
