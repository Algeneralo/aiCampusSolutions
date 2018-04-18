@extends('Admin.layout')
@section('body')
    @if(session('success'))
        <div class="note note-info">
            <h4 class="block"><b>Success</b></h4>
            <p>{{session('success')}}</p>
        </div>
    @endif
    <div class="panel panel-success">
        <div class="panel-heading text-center">
            Question's Table
        </div>
        <div class="panel-body">
            <div class="col-md-12">
                <a href="\uploadSpreadsheet" class="btn green-meadow pull-right">
                    <i class="fa fa-plus"></i>
                    Upload Spreadsheet
                </a>
            </div>
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Question</th>
                    <th>College</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($questionsCategory as $qC)
                    <tr>
                        <td hidden>{{encrypt($qC->id)}}</td>
                        <td hidden>{{$qC->college_id+26497}}</td>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$qC->question}}</td>
                        <td>{{$qC->college_name}}</td>
                        <td>
                            {{--26497 it's just a key to hide the real ids--}}
                            <a id="edit_btn" class="btn green"
                               href="{{route('questions.show',$qC->id+26497)}}">
                                <i class="fa fa-search"></i>
                                View Questions
                            </a>
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
                @if(count($questionsCategory)==0)
                    <tr>
                        <td class="text-center" colspan="4">No data found</td>
                    </tr>
                @endif
                </tbody>
            </table>
            {{$questionsCategory->links()}}
        </div>
    </div>
    @include('Admin.QuestionCategory.Modal.edit')
@endsection
@section('script')
    @include('Admin.QuestionCategory.scripts.edit')
    @include('Admin.QuestionCategory.scripts.delete')
@endsection