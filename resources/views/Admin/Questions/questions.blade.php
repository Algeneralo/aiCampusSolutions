@extends('Admin.layout')
@section('style')
    <style>
        #questions_table td:nth-child(5), #questions_table td:nth-child(6) {
            word-break: break-all;
        }

        textarea {
            resize: none;
        }
    </style>
@endsection
@section('body')
    @if(session('error'))
        <div class="note note-danger">
            <h4 class="block"><b>{{session('error')}}</b></h4>
            <p>{{session('msg')}}</p>
        </div>
    @elseif(session('success'))
        <div class="note note-info">
            <h4 class="block"><b>Success</b></h4>
            <p>{{session('success')}}</p>
        </div>
    @endif
    <div class="panel panel-success">
        <div class="panel-heading text-center">
            Questions For <b>"{{$table->question}}"</b> , <b>{{$table->college->name}}</b> College
        </div>
        <div class="panel-body">
            <div class="col-md-12">
                <a class="btn green-meadow pull-right" data-toggle="modal" data-target="#add_modal">
                    <i class="fa fa-plus"></i>
                    New Question
                </a>
            </div>
            <table id="questions_table" class="table table-hover">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Subject</th>
                    <th>info</th>
                    <th>link1</th>
                    <th>link2</th>
                    <th>link3</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($questions as $question)
                    <tr>
                        <td hidden>{{encrypt($question->id)}}</td>
                        <td>{{$loop->iteration}}</td>
                        <td width="20%">{{$question->subject}}</td>
                        <td width="30%">{{$question->info}}</td>
                        <td width="10%">@if(!empty($question->link1))<a href="{{$question->link1}}"
                                                                        target="_blank">{{$question->link1}}</a>
                            @else -
                            @endif
                        </td>
                        <td width="10%">@if($question->link2)<a href="{{$question->link2}}"
                                                                target="_blank">{{$question->link2}}</a>
                            @else -
                            @endif
                        </td>
                        <td width="10%">@if($question->link3)<a href="{{$question->link3}}"
                                                                target="_blank">{{$question->link3}}</a>
                            @else -
                            @endif
                        </td>
                        <td>
                            <a class="btn btn-warning edit_btn">
                                <i class="fa fa-edit"></i>
                                Edit
                            </a>
                            <a class="btn red delete_btn">
                                <i class="fa fa-times"></i>
                                Delete
                            </a>
                        </td>
                    </tr>
                @endforeach
                @if(count($questions)==0)
                    <tr>
                        <td class="text-center" colspan="7">No data found</td>
                    </tr>
                @endif
                </tbody>
            </table>
            {{ $questions->links() }}

        </div>
    </div>
    @include('Admin.Questions.Modal.add')
    @include('Admin.Questions.Modal.edit')
@endsection
@section('script')
    @include('Admin.Questions.scripts.add')
    @include('Admin.Questions.scripts.edit')
    @include('Admin.Questions.scripts.delete')
@endsection