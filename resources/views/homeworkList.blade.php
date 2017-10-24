@extends('templates.template')
@section('title', 'homework list')
@section('header')
    @include('components.header')
    <nav aria-label="breadcrumb" role="navigation">
        <ol class="breadcrumb">
            <li class="breadcrumb-item" aria-current="page"><a href="/">Home</a></li>
            <li class="breadcrumb-item" aria-current="page"><a href="/year">Year</a></li>
            <li class="breadcrumb-item" aria-current="page"><a href="/year/{{session()->get('year')}}/term">Term</a></li>
            <li class="breadcrumb-item" aria-current="page"><a href="/term/{{session()->get('term')}}/subject">Subject</a></li>
            <li class="breadcrumb-item active" aria-current="page">Homework</li>
        </ol>
    </nav>
@endsection
@section('content')
    <style>
        form {
            display:inline;
        }
    </style>
    <div class="card">
        <div class="card-header">
            <h3>Homework List</h3>
        </div>
        <div class="card-body">
            <button class="btn btn-success" data-toggle="modal" data-target="#addHomeworkModal" style="margin-bottom:20px">+ Create New Homework</button>
            @foreach($homeworks as $homework)
                <div class="card text-center card text-center {{$homework->status == 'doing' ? 'border border-warning' : ($homework->status == 'finished' ? 'border border-success' : ($homework->status == 'notfinish' ? 'border border-danger' : ''))}}">
                    <div class="card-body">
                        <h4 class="card-title">{{$homework->name}}</h4>
                        <form>
                            <a href="/homework/{{$homework->id}}/links" class="btn btn-primary">Document Link Of Homework</a>
                        </form>
                        <button class="btn btn-warning" data-toggle="modal" data-target="#editHomeworkModal" data-id="{{$homework->id}}" data-name="{{$homework->name}}" data-order-date="{{$homework->order_date}}" data-sent-date="{{$homework->sent_date}}" data-status="{{$homework->status}}">Edit</button>
                        <form action="/delete-homework/{{$homework->id}}" method="post">
                            {{csrf_field()}}
                            {{method_field('DELETE')}}
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                    <div class="card-footer text-muted">
                        <span>Order: {{$homework->order_date}}</span>
                        Sent: <span class="{{$homework->status == 'finished'? '' : ($homework->status == 'notfinish' ? '' : 'sent')}}" id="{{$loop->index + 1}}">{{$homework->sent_date}}</span>
                        <br>
                        <span id="{{'printSentDate'.($loop->index + 1)}}"></span> left
                    </div>
                </div>
                <br>
            @endforeach
        </div>
    </div>
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
                 <form action="/add-homework" method="get"  autocomplete="off">
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
            $('button.btn-danger').on('click', function() {
               var result = confirm('Are you sure?');
               if(!result) {
                   return false;
               }
            });
        });
    </script>
@endsection