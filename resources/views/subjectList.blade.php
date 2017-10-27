@extends('templates.template')
@section('title', 'subject list')
@section('header')
    @include('components.header')
    <nav aria-label="breadcrumb" role="navigation">
        <ol class="breadcrumb">
            <li class="breadcrumb-item" aria-current="page"><a href="/">Home</a></li>
            <li class="breadcrumb-item" aria-current="page"><a href="/year">Year</a></li>
            <li class="breadcrumb-item" aria-current="page"><a href="/year/{{session()->get('year')}}/term">Term</a></li>
            <li class="breadcrumb-item active" aria-current="page">Subject</li>
        </ol>
    </nav>
@endsection
@section('content')
    <style>
        .card-body button:first-child {
            margin-bottom:20px;
        }
        tr td.bg-primary {
            color:#fff;
        }
        tr td.bg-info {
            color:#fff;
        }
        tr td.status {
            color:#fff;
        }
        tr td a {
            font-size:16px!important;
        }
        tr td form  {
            display:inline;
        }
    </style>
    <div class="card">
        <div class="card-header">
            <h3>Subject List</h3>
        </div>
        <div class="card-body">
        <button class="btn btn-success" data-toggle="modal" data-target="#addSubjectModal">+CreateNewSubject</button>
        <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th>SubjectCode</th>
                        <th>Name</th>
                        <th>Professor</th>
                        <th>ProfessorWeb</th>
                        <th>status</th>
                        <th>BeginStudy</th>
                        <th>Tools</th>
                    </tr>
                </thead>
                <tbody>
                    @if(count($subjects) == 0) 
                        <tr>
                            <td colspan="7" class="text-center"><h3>.....Empty.....</h3></td>
                        </tr>
                    @endif
                    @foreach($subjects as $subject)
                    <tr>
                        <td class="bg-primary">{{$subject->subject_code}}</td>
                        <td class="bg-info">{{$subject->name}}</td>
                        <td>{{$subject->professor_name}}</td>
                        <td>
                            <a href="{{$subject->professor_web}}" target="_blank">{{$subject->professor_web}}</a>
                        </td>
                        <td class="status {{$subject->status == 'studying' ? 'bg-warning' : ($subject->status == 'passed' ? 'bg-success' : ($subject->status == 'notpass' ? 'bg-danger' : ''))}}">{{$subject->status}}</td>
                        <td>{{$subject->begin_date}}</td>
                        <td>
                            <a href="/subject/{{$subject->id}}/homework" class="btn btn-primary"><span class="badge badge-{{$subject->numOfHomework > 0 ?'danger' : 'light'}}">{{$subject->numOfHomework}}</span> Homework</a>
                            <button class="btn btn-warning" data-toggle="modal" data-target="#editSubjectModal" data-id="{{$subject->id}}" data-subject-code="{{$subject->subject_code}}" data-subject-name="{{$subject->name}}" data-status="{{$subject->status}}" data-begin-date="{{$subject->begin_date}}" data-professor-name="{{$subject->professor_name}}" data-professor-web="{{$subject->professor_web}}">Edit</button>
                            <form action="\delete-subject\{{$subject->id}}" method="post">
                                {{csrf_field()}}
                                {{ method_field('DELETE') }}
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
        </table>
        </div>
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
                 <form action="/add-subject" method="get"  autocomplete="off">
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
