@extends('Admin.layout')
@section('style')
    <style>
        .btn, .form-control {
            box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075) !important;
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
    <div class="note note-info">
        <h4 class="block"><b>Notes:</b></h4>
        <b>1.</b>You have to put a header in all files, like this: <b>Subject | info | link1 | link2 | link3</b>
        <br>
        <b>2.</b>Upload take only first sheet
    </div>
    <div class="panel panel-primary">
        <div class="panel-heading text-center">
            Upload Spreadsheet
        </div>
        <div class="panel-body">
            <form id="uploadSpreadsheet_form" method="post" action="\uploadSpreadsheet" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-group col-md-3">
                    <label for="college">Choose College</label>
                    <select name="college" class="form-control" value="{{old('college')??''}}">
                        <option disabled selected value="1">Please select college</option>
                        @foreach($colleges as $college)
                            <option value="{{encrypt($college->id)}}">{{$college->name}}</option>
                        @endforeach
                    </select>
                    @if($errors->has("college"))
                        <p style="color: red">{{ $errors->first("college") }}</p>
                    @endif
                </div>
                <div class="form-group col-md-3">
                    <label for="QuestionCategory">Question Category</label>
                    <input name="QuestionCategory" type="text" class="form-control"
                           value="{{old('QuestionCategory')??''}}"
                           placeholder="Ex:Where is">
                    @if($errors->has("QuestionCategory"))
                        <p style="color: red">{{ $errors->first("QuestionCategory") }}</p>
                    @endif
                </div>
                <div class="form-group col-md-3">
                    <label for="spreadsheet">Spreadsheet File</label>
                    <input name="spreadsheet" type="file" class="form-control">
                    @if($errors->has("spreadsheet"))
                        <p style="color: red">{{ $errors->first("spreadsheet") }}</p>
                    @endif
                </div>
                <div class="form-group col-md-1">
                    <br>
                    <input type="submit" class="btn green">

                </div>
            </form>
            <div class="form-group col-md-1">
                <br>
                <a href="\questionCategory" class="btn red">
                    Cancel
                </a>
            </div>
        </div>
    </div>
@endsection
@section('script')
    @include('Admin.scripts.uploadSpreadsheet')
@endsection