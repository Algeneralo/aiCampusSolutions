@extends('Admin.layout')
@section('body')
    @if(session('success'))
        <div class="alert alert-success">
              <strong>Success!</strong> {{session('success')}}
        </div>
    @elseif(session('error'))
        <div class="alert alert-danger">
            <strong>{{session('error')}}</strong> ,{{session('msg')}}
        </div>
    @endif
    <div class="panel panel-success">
        <div class="panel-heading text-center">
            Colleges' Table
        </div>
        <div class="panel-body">
            <div class="col-md-12">
                <a class="btn green-meadow pull-right" data-toggle="modal" data-target="#add_modal">
                    <i class="fa fa-plus"></i>
                    New College
                </a>
            </div>
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>#</th>
                    <th>College</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($colleges as $college)
                    <tr>
                        <td hidden>{{encrypt($college->id)}}</td>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$college->name}}</td>
                        <td>
                            {{--26497 it's just a key to hide the real id's--}}
                            <a id="edit_btn" class="btn green"
                               href="{{route('questionCategory.show',$college->id+26497)}}">
                                <i class="fa fa-search"></i>
                                View College questions
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
                @if(count($colleges)==0)
                    <tr>
                        <td class="text-center" colspan="4">No data found</td>
                    </tr>
                @endif
                </tbody>
            </table>
            {{$colleges->links()}}
        </div>
    </div>
    @include('Admin.Colleges.Modal.add')
    @include('Admin.Colleges.Modal.edit')
@endsection
@section('script')
    @include('Admin.Colleges.scripts.add')
    @include('Admin.Colleges.scripts.edit')
    @include('Admin.Colleges.scripts.delete')
@endsection