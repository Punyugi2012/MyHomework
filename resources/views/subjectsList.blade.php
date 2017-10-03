@extends('templates.template')
@section('title', 'subjects list')
@section('header')
    @include('components.header', ['logo'=>'SUBJECTS LIST'])
@endsection
@section('content')
    <style>
      .studying {
          border:3px solid #F1C40F;
      }
      .passed {
          border:3px solid #27AE60;
      }
      .notpassed {
          border:3px solid #C0392B;
      }
      div.card {
          width:200px;
      }
      div.alert {
          margin-top:80px;
      }
      div.group-form {
          display:inline;
          float:right;
      }
      form {
          display:inline;
      }
    </style>
    <div align="center" style="margin-top:50px;margin-bottom:30px">
        <div class="card">
            <h1>Subjects</h1>
        </div>
        <br>
        <button class="btn btn-success" style="display:inline">+ Add Subject</button>
        @if(count($subjects) == 0)
            <div class="alert alert-danger">
                <h1>No Subjects.</h1>
            </div>
        @endif
        @foreach($subjects as $subject)
            <div class="card text-center {{$subject->status == 'studying' ? 'studying' : ($subject->status == 'passed' ? 'passed' : ($subject->status == 'notpassed' ? 'notpassed' : ''))}}" style="width:50%;margin-top:20px">
                <div class="card-body">
                    <h1 class="card-title">{{$subject->name}}</h1>
                    <p class="card-text">{{$subject->professor_name}}</p>
                    <a href="#" class="btn btn-primary">Go Homeworks</a>
                    <button class="btn btn-info">Detail</button>
                    <div class="group-form">
                        <form>
                            <button type="submit" class="btn btn-warning">Edit</button>
                        </form>
                        <form>
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                </div>
                <div class="card-footer text-muted">
                    {{$subject->subject_date}}
                </div>
            </div>
        @endforeach
    </div>
@endsection
