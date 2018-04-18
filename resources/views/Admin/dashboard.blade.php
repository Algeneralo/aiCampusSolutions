@extends('Admin.layout')
@section('body')
    <br>
    <div class="col-md-3">
        <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 ">
            <h4 class="widget-thumb-heading">Colleges</h4>
            <div class="widget-thumb-wrap">
                <i class="widget-thumb-icon bg-green fa fa-university"></i>
                <div class="widget-thumb-body">
                    <span class="widget-thumb-subtitle">Count</span>
                    <span class="widget-thumb-body-stat" data-counter="counterup"
                          data-value="{{$colleges}}">{{$colleges}}</span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 ">
            <h4 class="widget-thumb-heading">Questions Category</h4>
            <div class="widget-thumb-wrap">
                <i class="widget-thumb-icon bg-red fa fa-question-circle"></i>
                <div class="widget-thumb-body">
                    <span class="widget-thumb-subtitle">Count</span>
                    <span class="widget-thumb-body-stat" data-counter="counterup"
                          data-value="{{$questionCategory}}">{{$questionCategory}}</span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 ">
            <h4 class="widget-thumb-heading">Questions</h4>
            <div class="widget-thumb-wrap">
                <i class="widget-thumb-icon bg-purple fa fa-question"></i>
                <div class="widget-thumb-body">
                    <span class="widget-thumb-subtitle">Count</span>
                    <span class="widget-thumb-body-stat" data-counter="counterup"
                          data-value="{{$questions}}">{{$questions}}</span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 ">
            <h4 class="widget-thumb-heading">Suggestions</h4>
            <div class="widget-thumb-wrap">
                <i class="widget-thumb-icon bg-blue fa fa-question"></i>
                <div class="widget-thumb-body">
                    <span class="widget-thumb-subtitle">Count</span>
                    <span class="widget-thumb-body-stat" data-counter="counterup"
                          data-value="{{$suggestions}}">{{$suggestions}}</span>
                </div>
            </div>
        </div>
    </div>
@endsection