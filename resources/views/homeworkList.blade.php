@extends('templates.template')
@section('title', 'homework list')
@section('header')
    @include('components.header', ['logo'=>'HOMEWORK LIST'])
@endsection
@section('content')
    <style>
        div.card {
            width:250px;
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
        div.text-center {
            width:50%;
            margin-top:20px;
        }
        .doing {
            border:3px solid #F1C40F;
        }
        .finished {
            border:3px solid #27AE60;
        }
        .not-finish {
            border:3px solid #C0392B;
        }
    </style>
    <div align="center" style="margin-top:50px;margin-bottom:30px">
        <div class="card">
            <h1>Homeworks</h1>
        </div>
        <br>
        <button class="btn btn-success" data-toggle="modal" data-target="#addHomeworkModal">+ Add Homework</button>
        @if(count($homeworks) == 0)
            <div class="alert alert-danger">
                <h1>No Homework.</h1>
            </div>
        @endif
            @foreach($homeworks as $homework)
                <div class="card text-center {{$homework->status == 'doing' ? 'doing' : ($homework->status == 'finished' ? 'finished' : ($homework->status == 'notfinish' ? 'not-finish' : ''))}}">
                    <div class="card-body">
                        <h1 class="card-title">{{$homework->name}}</h1>
                        <div class="group-form">
                            <button class="btn btn-primary">Detail</button>
                            <form>
                                <button type="submit" class="btn btn-info">Links</button>
                            </form>
                            <button class="btn btn-warning">Edit</button>
                            <form>
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </div>
                    </div>
                    <div class="card-footer text-muted">
                        <span>Order: {{$homework->order_date}}</span>
                        Sent: <span class="sent" id="{{$loop->index + 1}}">{{$homework->sent_date}}</span>
                        <br>
                        Remaining time : <span id="{{'printDate'.($loop->index + 1)}}"></span>
                    </div>
                </div>
            @endforeach
    </div>
    <script type="text/javascript">
        $(document).ready(function() {
            function countdown(element, moth, day, year) {
                var timeFormat = moth + " " + day + ", " + year + " 00:00:00";
                var countDownDate = new Date(timeFormat).getTime();
                var x = setInterval(function() {
                    var now = new Date().getTime();
                    var distance = countDownDate - now;
                    var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                    var seconds = Math.floor((distance % (1000 * 60)) / 1000);
                    document.getElementById(element).innerHTML = days + "d " + hours + "h "
                    + minutes + "m " + seconds + "s ";
                    if (distance < 0) {
                        clearInterval(x);
                        document.getElementById(element).innerHTML = "TIME OUT";
                    }
                }, 1000);
            }
           /*$('.sent').map(function() {
                var splited = $(this).text().split("-");
                countdown("printDate" + $(this).attr('id'), parseInt(splited[1]), parseInt(splited[2]), parseInt(splited[0]));
            });*/
        });
    </script>
@endsection
@section('footer')
    <div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="addHomeworkModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                 <div class="modal-header">
                    <h5 class="modal-title">+Add Homework</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                 <form action="/add-homework" method="post"  autocomplete="off">
                    <div class="modal-body">
                        <div class="form-group">
                            {{csrf_field()}}
                            <label for="nameHomework">Name:</label>
                            <input type="text" class="form-control" name="nameHomework" id="nameHomework">
                        </div>
                        <div class="form-group">
                            <label for="orderDate">Order Date:</label>
                            <input type="date" class="form-control" name="orderDate" id="orderDate">
                        </div>
                        <div class="form-group">
                            <label for="sentDate">Sent Date:</label>
                            <input type="date" class="form-control" name="sentDate" id="sentDate">
                        </div>
                        <div class="form-group">
                            <label for="status">Status:</label>
                            <select class="form-control" name="status" id="status">
                                <option value=""></option>
                                <option value="0">None</option>
                                <option value="1">Doing</option>
                                <option value="2">finished</option>
                                <option value="3">notfinish</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
             </div>
        </div>
    </div>
@endsection