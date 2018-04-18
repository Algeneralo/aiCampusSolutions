@extends('student.layout')
@section('style')
    <style>
        #Search_table td:nth-child(6), #Search_table td:nth-child(7) {
            word-break: break-all;
        }

        textarea {
            resize: none;
        }

        .loader {
            border: 16px solid #f3f3f3;
            border-radius: 50%;
            border-top: 16px solid blue;
            border-bottom: 16px solid blue;
            width: 120px;
            height: 120px;
            -webkit-animation: spin 2s linear infinite;
            animation: spin 2s linear infinite;
            margin: 25px auto 41px auto;
        }

        @-webkit-keyframes spin {
            0% {
                -webkit-transform: rotate(0deg);
            }
            100% {
                -webkit-transform: rotate(360deg);
            }
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }
            100% {
                transform: rotate(360deg);
            }
        }

        #loader_modal .modal-header {
            border-bottom: 0;
        }

        #add_modal .row {
            margin-left: 0 !important;
            margin-right: 0 !important;
        }
    </style>
@endsection
@section('body')
    <div class="container">
        @if(session('success'))
            <div class="alert alert-success">
                  <strong>Success!</strong> {{session('success')}}
            </div>
        @elseif(session('warning'))
            <div class="alert alert-warning">
                <strong>Warning!</strong> ,{{session('warning')}}
            </div>
        @elseif(session('error'))
            <div class="alert alert-danger">
                <strong>{{session('error')}}</strong> ,{{session('msg')}}
            </div>
        @endif
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Search for {{$college->name ??' '}} college</div>
                    <div class="panel-body">
                        <form id="search_data_form" class="form-horizontal">
                            <div class="col-md-4">
                                <input id="college_id" value="{{$college->id}}" type="hidden">
                                <input id="search_keyword" name="search_keyword" type="text" class="form-control"
                                       placeholder="Keyword like: bookstore,cafeteria">
                            </div>
                            <button type="button" class="btn btn-success pull-right" data-toggle="modal"
                                    data-target="#add_modal">
                                <span class="glyphicon glyphicon-plus"></span> Suggest new data
                            </button>
                            <input type="submit" class="btn btn-primary" value="Search">
                        </form>
                        <br><br>
                        <form id="suggestion_info_form" method="post" action="\Suggestion">
                            {{csrf_field()}}
                            <div class="panel panel-success">
                                <table id="Search_table" class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th></th>
                                        <th width="25%">Subject</th>
                                        <th width="30%">Info</th>
                                        <th width="14%">Link1</th>
                                        <th width="14%">Link2</th>
                                        <th>Edit</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <th colspan="6" class="text-center">Search to get data</th>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            @include('student.studentInfoForm')
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('student.Modal.Loader')
    @include('student.Modal.SuggestionAddType')
@endsection
@section('script')
    @include('student.script.search')
    @include('student.script.suggestion')
@endsection