@extends('layouts.master')

@section('custom_styles')
    <link rel="stylesheet" type="text/css" href="/css/style.css">
@endsection

@section('content')

    <div class="row">
        <div class="col-md-8">
            <a href="/images/exams/{{ $exam->id }}.jpg">
                <img style="width: 100%;" src="/images/exams/{{ $exam->id }}.jpg">
            </a>
        </div>

        <div class="col-md-4">
            @if (Auth::user() && Auth::user()->role != 1)
                <a href="/exams/delete/{{ $exam->id }}" class="btn btn-danger">Delete Exam</a>
            @endif

            @if (Auth::user())
                <a href="/solutions/{{ $exam->id }}/create" class="btn btn-primary">Add Solution</a>
            @endif

            @if(isset($solutions)&& $solutions->count())
                <div id="accordion">
                    @foreach( $solutions as $solution)
                        <h3 style="cursor: pointer; outline: none;" class="well well-sm">{{ $solution->title }} <i class="fa fa-caret-down"></i></h3>
                        <div>
                            <img style="width: 100%;" src="/images/solutions/{{ $solution->id }}.jpg">
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
@endsection
