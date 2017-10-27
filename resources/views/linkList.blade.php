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
            <li class="breadcrumb-item" aria-current="page"><a href="/subject/{{session()->get('subject')}}/homework">Homework</a></li>
            <li class="breadcrumb-item active" aria-current="page">Link Document</li>
        </ol>
    </nav>
@endsection
@section('content')
    <form action="/add-link" method="get">
        <div class="row">
            <div class="form-group col-3">
                {{csrf_field()}}
                <input type="text" class="form-control" name="nameUrl" id="name" placeholder="description" required>
            </div>
            <div class="form-group col-3">
                <input type="url" class="form-control" name="url" id="url" placeholder="url" required>
            </div>
            <div class="form-group col-3">
                <button type="submit" class="btn btn-primary">Save</button>
                <button type="reset" class="btn btn-danger">Reset</button>
            </div>
        </div>
    </form>
   <div class="card">
        <div class="card-header">
            <h3>Link Document</h3>
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>    
                        <th>
                            Description
                        </th>
                        <th>
                            URL
                        </th>
                        <th>
                            Tools
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($links as $link)
                        <tr>
                            <td>
                                {{$link->name}}
                            </td>
                            <td>
                                <a href="{{$link->link_url}}" target="_blank">{{$link->link_url}}</a>
                            </td>
                            <td>
                                <button class="btn btn-warning" data-toggle="modal" data-target="#editLinkModal" data-id="{{$link->id}}" data-name="{{$link->name}}" data-url="{{$link->link_url}}">Edit</button>
                                <form action="/delete-link/{{$link->id}}" method="post" class="d-inline">
                                    {{csrf_field()}}
                                    {{method_field('DELETE')}}
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            <table>
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
            $('button.btn-danger').on('click', function() {
               var result = confirm('Are you sure?');
               if(!result) {
                   return false;
               }
            });
        });
    </script>
@endsection