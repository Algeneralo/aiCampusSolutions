@extends('Admin.layout')
@section('style')
    <style>
        table td:nth-child(7), table td:nth-child(8) {
            word-break: break-all;
        }

        textarea {
            resize: none;
        }

        #green_span {
            width: 20px;
            height: 20px;
            background-color: #dff0d8;
            display: inline-block;
        }

        #red_span {
            width: 20px;
            height: 20px;
            background-color: #fbe1e3;
            display: inline-block;
        }

        .panel-primary > .panel-heading, .panel-default > .panel-heading {
            cursor: pointer;
        }
    </style>
@endsection
@section('body')
    <div class="panel panel-info">
        <div class="panel-heading text-center">
            Suggestions 'Edit'
        </div>
        <div class="panel-body">
            <div class="note note-default">
                <h4 class="block"><b>Note:</b></h4>
                <b>To show suggestions:</b><span> press on Student to show his suggestion</span>
                <br>
                <span id="green_span"></span>
                <span>Green cell means there is no change in data</span>
                <br>
                <span id="red_span"></span>
                <span>Red cell means there is change in data</span>
            </div>
            @foreach($students as $student)
                <div class="panel panel-primary">
                    <div class="panel-heading text-center">
                        Student {{$studentNum=$loop->iteration}}
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
                        <br><br><br><br><br>
                        @foreach($student->suggestions as $suggestion)
                            <div class="panel panel-default">
                                <div class="panel-heading text-center">
                                    Suggestion {{$loop->iteration}} ,for student {{$studentNum}}
                                </div>
                                <div class="panel-body" style="display: none">
                                    <table class="table table-hover">
                                        <thead>
                                        <tr>
                                            <th width="8%"></th>
                                            <th width="20%">Subject</th>
                                            <th>info</th>
                                            <th>link1</th>
                                            <th>link2</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <th>Current</th>
                                            <td hidden></td>
                                            <td hidden></td>
                                            <td hidden></td>
                                            <td width="20%"
                                                class="{{$suggestion->old_subject==$suggestion->subject?'success':'danger'}}">
                                                {{$suggestion->old_subject}}
                                            </td>
                                            <td width="30%"
                                                class="{{$suggestion->old_info==$suggestion->info?'success':'danger'}}">
                                                {{$suggestion->old_info}}
                                            </td>
                                            <td width="10%"
                                                class="{{$suggestion->old_link1==$suggestion->link1?'success':'danger'}}">
                                                @if(!empty($suggestion->old_link1))
                                                    <a href="{{$suggestion->old_link1}}"
                                                       target="_blank">{{$suggestion->old_link1}}</a>
                                                @endif
                                            </td>
                                            <td width="10%"
                                                class="{{$suggestion->old_link2==$suggestion->link2 ?'success':'danger'}}">
                                                @if($suggestion->old_link2)
                                                    <a href="{{$suggestion->old_link2}}"
                                                       target="_blank">{{$suggestion->old_link2}}</a>
                                                @else {{''}}
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Suggestion</th>
                                            <td hidden>{{$student->email}}</td>
                                            <td hidden>{{encrypt($suggestion->id)}}</td>
                                            <td hidden>{{encrypt($suggestion->question_id)}}</td>
                                            <td width="20%">
                                                <textarea class="form-control">{{$suggestion->subject ?? ''}}</textarea>
                                                <label class="error" style="display: none">
                                                    This field is required.
                                                </label>
                                            </td>
                                            <td width="30%">
                                                <textarea class="form-control">{{$suggestion->info ?? ''}}</textarea>
                                                <label class="error" style="display: none">
                                                    This field is required.
                                                </label>
                                            </td>
                                            <td width="10%">
                                                <textarea class="form-control">{{$suggestion->link1 ?? ''}}</textarea>
                                                <label class="error" style="display: none">
                                                    This field is required.
                                                </label>
                                            </td>
                                            <td width="10%">
                                                <textarea class="form-control">{{$suggestion->link2 ?? ''}}</textarea>
                                                <label class="error" style="display: none">
                                                    This field is required.
                                                </label>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <hr>
                                    <div class="col-md-12 text-center">
                                        <a class="btn btn-warning approve_btn">
                                            <i class="fa fa-check"></i>
                                            Approve
                                        </a>
                                        <a class="btn red reject_btn">
                                            <i class="fa fa-times"></i>
                                            Reject
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
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
    @include('Admin.Suggestions.scripts.editSuggestion')
@endsection