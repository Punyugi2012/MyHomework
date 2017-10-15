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
        h1 {
            display:inline;
        }
    </style>
    <div style="margin-top:20px">
        <h1 style="color:#0000FF">Year:{{$year}}</h1> <h1>--></h1>
        @if($term == "3")
            <h1 style="color:#800080">Term: Summer</h1> <h1>--></h1>
        @else
            <h1 style="color:#800080">Term: {{$term}}</h1> <h1>--></h1>
        @endif
        <h1 style="color:#FF7373">Subject: {{$subjectName}}</h1>
    </div>
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
                        <h2 class="card-title">{{$homework->name}}</h2>
                        <div class="group-form">
                            <form action="/homework/{{$homework->id}}/links" method="get">
                                <button type="submit" class="btn btn-info">Links</button>
                            </form>
                            <button class="btn btn-warning" data-toggle="modal" data-target="#editHomeworkModal" data-id="{{$homework->id}}" data-name="{{$homework->name}}" data-order-date="{{$homework->order_date}}" data-sent-date="{{$homework->sent_date}}" data-status="{{$homework->status}}">Edit</button>
                            <form action="/delete-homework/{{$homework->id}}" method="post">
                                {{csrf_field()}}
                                {{method_field('DELETE')}}
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </div>
                    </div>
                    <div class="card-footer text-muted">
                        <span>Order: {{$homework->order_date}}</span>
                        Sent: <span class="{{$homework->status == 'finished'? '' : ($homework->status == 'notfinish' ? '' : 'sent')}}" id="{{$loop->index + 1}}">{{$homework->sent_date}}</span>
                        <br>
                        <span id="{{'printSentDate'.($loop->index + 1)}}"></span> left
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
           $('.sent').map(function() {
                var splited = $(this).text().split("-");
                countdown("printSentDate" + $(this).attr('id'), parseInt(splited[1]), parseInt(splited[2]), parseInt(splited[0]));
            });
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
                 <form action="/add-homework/{{$id}}"method="post"  autocomplete="off">
                    <div class="modal-body">
                        <div class="form-group">
                            {{csrf_field()}}
                            <label for="nameHomework">Name:</label>
                            <input type="text" class="form-control" name="nameHomework" id="nameHomework" required>
                        </div>
                        <div class="form-group">
                            <label for="orderDate">Order Date:</label>
                            <input type="date" class="form-control" name="orderDate" id="orderDate" required>
                        </div>
                        <div class="form-group">
                            <label for="sentDate">Sent Date:</label>
                            <input type="date" class="form-control" name="sentDate" id="sentDate" required>
                        </div>
                        <div class="form-group">
                            <label for="status">Status:</label>
                            <select class="form-control" name="status" id="status" required>
                                <option value=""></option>
                                <option value="0">None</option>
                                <option value="1">Doing</option>
                                <option value="2">Finished</option>
                                <option value="3">Notfinish</option>
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
    <div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="editHomeworkModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                 <div class="modal-header">
                    <h5 class="modal-title">Edit Homework</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                 <form  method="post"  autocomplete="off">
                    <div class="modal-body">
                        <div class="form-group">
                            {{csrf_field()}}
                            {{method_field('PUT')}}
                            <label for="edit-nameHomework">Name:</label>
                            <input type="text" class="form-control" name="editNameHomework" id="edit-nameHomework" required>
                        </div>
                        <div class="form-group">
                            <label for="edit-orderDate">Order Date:</label>
                            <input type="date" class="form-control" name="editOrderDate" id="edit-orderDate" required>
                        </div>
                        <div class="form-group">
                            <label for="edit-sentDate">Sent Date:</label>
                            <input type="date" class="form-control" name="editSentDate" id="edit-sentDate" required>
                        </div>
                        <div class="form-group">
                            <label for="edit-status">Status:</label>
                            <select class="form-control" name="editStatus" id="edit-status" required>
                                <option value=""></option>
                                <option value="0">None</option>
                                <option value="1">Doing</option>
                                <option value="2">Finished</option>
                                <option value="3">Notfinish</option>
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
    <script type="text/javascript">
        $(document).ready(function() {
            $('#addHomeworkModal').on('hidden.bs.modal', function (e) {
                $(this)
                    .find("input")
                    .val('')
                    .end()
            });
            function convertStatus(status) {
                if(status == "none") {
                    return "0";
                }
                if(status == "doing") {
                    return "1";
                }
                if(status == "finished") {
                    return "2";
                }
                return "3";
            }
            $('button.btn-warning').on('click', function() {
                $('#editHomeworkModal form').attr('action', '/edit-homework/' + $(this).data('id'));
                $('#edit-nameHomework').val($(this).data('name'));
                $('#edit-orderDate').val($(this).data('order-date'));
                $('#edit-sentDate').val($(this).data('sent-date'));
                var status = convertStatus($(this).data('status'));
                $('#edit-status').val(status);
            });
        });
    </script>
@endsection