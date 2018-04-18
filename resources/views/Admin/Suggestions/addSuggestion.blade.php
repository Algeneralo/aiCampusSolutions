@extends('Admin.layout')
@section('style')
    <style>
        td:nth-child(6), td:nth-child(7) {
            word-break: break-all;
        }

        textarea {
            resize: none;
        }

        .panel-info > .panel-heading{
            cursor: pointer;
        }
    </style>
@endsection
@section('body')
    <div class="panel panel-success">
        <div class="panel-heading text-center">
            Suggestions 'Add'
        </div>
        <div class="panel-body">
            <div class="note note-default">
                <h4 class="block"><b>Note:</b></h4>
                <b>To show suggestions:</b><span> press on Student to show his suggestion</span>
            </div>
            @foreach($students as $student)
                <div class="panel panel-info">
                    <div class="panel-heading text-center">
                        Student {{$loop->iteration}}
                    </div>
                    <div class="panel-body" style="display: none">
                        <div class="form-group col-md-4 form-inline">
                            <label>Name:</label>
                            <input disabled value="{{$student->name}}" type="text" class="form-control">
                        </div>
                        <div class="form-group col-md-4 form-inline">
                            <label>Email:</label>
                            <input disabled value="{{$student->email}}" type="text" class="form-control">
                        </div>
                        <div class="form-group col-md-4 form-inline">
                            <label>Department:</label>
                            <input disabled value="{{$student->department}}" type="text" class="form-control">
                        </div>
                        <div class="form-group col-md-4 form-inline">
                            <label>Ext.&nbsp&nbsp&nbsp:</label>
                            <input disabled value="{{$student->ext}}" type="text" class="form-control">
                        </div>
                        <div class="form-group col-md-offset-4 col-md-4 form-inline">
                            <label>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspCollege:</label>
                            <input disabled value="{{$student->college_name}}" type="text" class="form-control">
                        </div>
                        <hr>
                        <table id="suggestions_table" class="table table-hover">
                            <thead>
                            <tr>
                                <th></th>
                                <th>Question Category</th>
                                <th>Subject</th>
                                <th>info</th>
                                <th>link1</th>
                                <th>link2</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($student->suggestions as $suggestion)
                                <tr>
                                    <th></th>
                                    <td hidden>{{$student->email}}</td>
                                    <td hidden>{{encrypt($suggestion->id)}}</td>
                                    <td width="16%">
                                        <select name="questionCategory" required class="form-control">
                                            <option disabled selected value="null">Choose Category</option>
                                            @foreach($student->questionCategories as $questionCategory)
                                                <option value="{{encrypt($questionCategory->id)}}">
                                                    {{$questionCategory->question}}
                                                </option>
                                            @endforeach
                                        </select>
                                        <label class="error" style="display: none">
                                            This field is required.
                                        </label>
                                    </td>
                                    <td width="17%">
                                        <textarea class="form-control">{{$suggestion->subject}}</textarea>
                                    </td>
                                    <td width="27%">
                                        <textarea class="form-control">{{$suggestion->info}}</textarea>
                                    </td>
                                    <td width="10%">
                                        <textarea class="form-control">{{$suggestion->link1}}</textarea>
                                    </td>
                                    <td width="10%">
                                        <textarea class="form-control">{{$suggestion->link2}}</textarea>
                                    </td>
                                    <td>
                                        <a class="btn btn-warning approve_btn">
                                            <i class="fa fa-check"></i>
                                            Approve
                                        </a>
                                        <a class="btn red reject_btn">
                                            <i class="fa fa-times"></i>
                                            Reject
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            @if(count($student->suggestions)==0)
                                <tr>
                                    <td class="text-center" colspan="7">No data found</td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            @endforeach
            @if(count($students)==0)
                <div class="panel panel-warning">
                    <div class="panel-heading text-center">
                        No Suggestions Found!
                    </div>
                </div>
            @endif
            {{ $students->links() }}

        </div>
    </div>

@endsection
@section('script')
    @include('Admin.Suggestions.scripts.addSuggestion')
@endsection