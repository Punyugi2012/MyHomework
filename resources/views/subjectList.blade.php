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
      .notpass {
          border:3px solid #C0392B;
      }
      div.card {
          width:200px;
          margin-bottom:20px;
          margin-top:10px;
      }
      div.alert {
          margin-top:80px;
      }
      div.group-form {
          display:inline;
          float:right;
      }
      form, .add-subject {
          display:inline;
      }
    </style>
    <div style="position: absolute">
        <div>
            <h1>Year: {{$year}}</h1>
        </div>
        <div>
            @if($term == "3")
                <h1>Term: Summer</h1>
            @else
                <h1>Term: {{$term}}</h1>
            @endif
        </div>
    </div>
    <div align="center" style="margin-top:50px;margin-bottom:30px">
        <div class="card">
            <h1>Subjects</h1>
        </div>
        <button class="btn btn-success add-subject" data-toggle="modal" data-target="#addSubjectModal">+ Add Subject</button>
        @if(count($subjects) == 0)
            <div class="alert alert-danger">
                <h1>No Subjects.</h1>
            </div>
        @endif
        @foreach($subjects as $subject)
            <div class="card text-center {{$subject->status == 'studying' ? 'studying' : ($subject->status == 'passed' ? 'passed' : ($subject->status == 'notpass' ? 'notpass' : ''))}}" style="width:50%;margin-top:20px">
                <div class="card-body">
                    <h1 class="card-title">{{$subject->name}}</h1>
                    <p class="card-text">{{$subject->professor_name}}</p>
                    <a href="/year/{{$year}}/term/{{$term}}/subject/{{$subject->id}}/homeworks" class="btn btn-primary">Go Homeworks</a>
                    <button class="btn btn-info" data-toggle="modal" data-target="#subjectDetail" data-target="#editSubjectModal" data-id="{{$subject->id}}" data-subject-code="{{$subject->subject_code}}" data-subject-name="{{$subject->name}}" data-status="{{$subject->status}}" data-begin-date="{{$subject->begin_date}}" data-professor-name="{{$subject->professor_name}}" data-professor-web="{{$subject->professor_web}}">Detail</button>                    
                    <div class="group-form">
                        <button class="btn btn-warning" data-toggle="modal" data-target="#editSubjectModal" data-id="{{$subject->id}}" data-subject-code="{{$subject->subject_code}}" data-subject-name="{{$subject->name}}" data-status="{{$subject->status}}" data-begin-date="{{$subject->begin_date}}" data-professor-name="{{$subject->professor_name}}" data-professor-web="{{$subject->professor_web}}">Edit</button>
                        <form action="\delete-subject\{{$subject->id}}" method="post">
                            {{csrf_field()}}
                            {{ method_field('DELETE') }}
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
@section('footer')
    <div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="addSubjectModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                 <div class="modal-header">
                    <h5 class="modal-title">+Add Subject</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                 <form action="/add-subject" method="post"  autocomplete="off">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="subjectCode">Subject Code:</label>
                            {{csrf_field()}}
                            <input type="text" class="form-control" placeholder="subject code" id="subjectCode" name="subjectCode" required>
                        </div>
                        <div class="form-group">
                            <label for="subjectName">Subject Name:</label>
                            <input type="text" class="form-control" placeholder="subject name" id="subjectName" name="subjectName" required>
                        </div>
                        <div class="form-group">
                            <label for="subjectStatus">Subject Status:</label>
                            <select class="form-control" id="subjectStatus" name="subjectStatus" required>
                                <option value="">Status</option>
                                <option value="1">Studying</option>
                                <option value="2">Passed</option>
                                <option value="3">Not pass</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="beginDate">Study Begin:</label>
                            <input type="date" class="form-control" id="beginDate" name="beginDate" required>
                        </div>
                        <div class="form-group">
                            <label for="professorName">Professor Name:</label>
                            <input type="text" class="form-control" placeholder="professor name" id="professorName" name="professorName">
                        </div>
                         <div class="form-group">
                            <label for="professorWeb">Professor Web:</label>
                            <input type="url" class="form-control" placeholder="professor name" id="professorWeb" name="professorWeb">
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
    <div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="editSubjectModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                 <div class="modal-header">
                    <h5 class="modal-title">Edit Subject</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                 <form method="post" autocomplete="off"> 
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="edit-subjectCode">Subject Code:</label>
                             {{csrf_field()}}
                             {{method_field('PUT')}}
                            <input type="text" class="form-control" placeholder="subject code" id="edit-subjectCode" name="edit-subjectCode" required>
                        </div>
                        <div class="form-group">
                            <label for="edit-subjectName">Subject Name:</label>
                            <input type="text" class="form-control" placeholder="subject name" id="edit-subjectName" name="edit-subjectName" required>
                        </div>
                        <div class="form-group">
                            <label for="edit-subjectStatus">Subject Status:</label>
                            <select class="form-control" id="edit-subjectStatus" name="edit-subjectStatus" required>
                                <option value="">Status</option>
                                <option value="1">Studying</option>
                                <option value="2">Passed</option>
                                <option value="3">Not pass</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="edit-beginDate">Study Begin:</label>
                            <input type="date" class="form-control" id="edit-beginDate" name="edit-beginDate" required>
                        </div>
                        <div class="form-group">
                            <label for="edit-professorName">Professor Name:</label>
                            <input type="text" class="form-control" placeholder="professor name" id="edit-professorName" name="edit-professorName">
                        </div>
                         <div class="form-group">
                            <label for="edit-professorWeb">Professor Web:</label>
                            <input type="url" class="form-control" placeholder="professor name" id="edit-professorWeb" name="edit-professorWeb">
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
     <div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="subjectDetail">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Subject Detail</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <ul class="list-group">
                        <li class="list-group-item">
                            <b>Subject Code:</b><span id="subject-code"></span>
                        </li>
                        <li class="list-group-item">
                            <b>Subject Name:</b><span id="subject-name"></span>
                        </li>
                        <li class="list-group-item">
                            <b>Subject Status:</b><span id="subject-status"></span>
                        </li>
                        <li class="list-group-item">
                            <b>Study Begin:</b><span id="subject-beginDate"></span>
                        </li>
                        <li class="list-group-item">
                            <b>Professor Name:</b><span id="professor-name"></span>
                        </li>
                        <li class="list-group-item">
                            <b>Professor Web:</b><a id="professor-web" target="_blank"></a>
                        </li>
                    </ul>                 
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#addSubjectModal').on('hidden.bs.modal', function (e) {
                $(this)
                    .find("input")
                    .val('')
                    .end()
            });
            function convertStatus(status) {
                if(status == 'studying') {
                    return '1';
                }
                if(status == 'passed') {
                    return '2';
                }
                else if(status == 'notpass'){
                    return '3';
                }
                return '';
            }
            $('button.btn-warning').on('click', function() {
                $('#editSubjectModal form').attr('action', '/edit-subject/' +  $(this).data('id'));
                $('#edit-subjectCode').val($(this).data('subject-code'));
                $('#edit-subjectName').val($(this).data('subject-name'));
                var status = $(this).data('status');
                status = convertStatus(status);
                $('#edit-subjectStatus').val(status);
                $('#edit-beginDate').val($(this).data('begin-date'));
                $('#edit-professorName').val($(this).data('professor-name'));
                $('#edit-professorWeb').val($(this).data('professor-web'));
            });
            $('button.btn-info').on('click', function() {
                $('#subject-code').html($(this).data('subject-code'));
                $('#subject-name').html($(this).data('subject-name'));
                $('#subject-status').html($(this).data('status'));
                $('#subject-beginDate').html($(this).data('begin-date'));
                $('#professor-name').html($(this).data('professor-name'));
                $('#professor-web').attr('href', $(this).data('professor-web'));
                $('#professor-web').html($(this).data('professor-web'));
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
