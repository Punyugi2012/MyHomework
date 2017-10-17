@extends('templates.template')
@section('title', 'link list')
@section('header')
    @include('components.header', ['logo'=>'LINK LIST'])
@endsection
@section('content')
    <style>
        h1 {
            display:inline;
        }
    </style>
    <div style="margin-top:20px">
               <h1 style="color:#0000FF">
            <a href="/year">Year</a>:{{$year}}
        </h1> <h1>--></h1>
        @if($term == "3")
            <h1 style="color:#800080">
                <a href="/year/{{$year}}/term">Term</a>: Summer
            </h1> <h1>--></h1>
        @else
            <h1 style="color:#800080">
                <a href="/year/{{$year}}/term">Term</a>: {{$term}}
            </h1> <h1>--></h1>
        @endif
        <h1 style="color:#FF7373">
            <a href="/term/{{$term}}/subject">Subject</a>: {{$subjectName}}
        </h1> <h1>--></h1>
        <h1 style="color:#008080">
            <a href="/subject/{{$subject}}/homework">Homework</a>: {{$homeworkName}}
        </h1>
    </div>
    <div class="row" style="margin-top:50px;margin-bottom:30px">
        <div class="col-md-6">
            <form action="/add-link" method="get">
                <div class="form-group">
                    {{csrf_field()}}
                    <label for="name-url" class="h1">Description:</label>
                    <input type="text" class="form-control" name="nameUrl" id="name-url" required>
                </div>
                <div class="form-group">
                    <label for="url" class="h1">URL:</label>
                    <input type="url" class="form-control" name="url" id="url" required>
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
                <button type="reset" class="btn btn-danger">Reset</button>
             </form>
        </div>
        <div class="col-md-6">
            @foreach($links as $link)
                <div class="card">
                    <div class="card-body text-center">
                        <h3>{{$link->name}}</h3>
                        <a href="{{$link->link_url}}" target="_blank">{{$link->link_url}}</a>
                        <form action="/delete-link/{{$link->id}}" method="post" class="float-right d-inline">
                            {{csrf_field()}}
                            {{method_field('DELETE')}}
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                        <button class="btn btn-warning float-right" data-toggle="modal" data-target="#editLinkModal" data-id="{{$link->id}}" data-name="{{$link->name}}" data-url="{{$link->link_url}}">Edit</button>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
@section('footer')
    <div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="editLinkModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                 <div class="modal-header">
                    <h5 class="modal-title">Edit Link</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                 <form method="post"  autocomplete="off">
                    <div class="modal-body">
                        <div class="form-group">
                            {{csrf_field()}}
                            {{method_field('PUT')}}
                            <label for="edit-linkName">Name:</label>
                            <input type="text" class="form-control" name="editLinkName" id="edit-linkName" required>
                        </div>
                        <div class="form-group">
                            <label for="edit-url">URl:</label>
                            <input type="url" class="form-control" name="editUrl" id="edit-url" required>
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
            $('.btn-warning').on('click', function() {
                $('#editLinkModal form').attr('action', '/edit-link/' + $(this).data('id'));
                $('#edit-linkName').val($(this).data('name'));
                $('#edit-url').val($(this).data('url'));
            });
        });
    </script>
@endsection