@extends('layouts.master')

@section('custom_styles')
    <link rel="stylesheet" type="text/css" href="/css/style.css">
@endsection

@section('content')

    <div class="row">
        <div class="col-md-8">
            <a target="_blank" href="/images/exams/{{ $exam->id }}.jpg">
                <img style="width: 100%;" src="/images/exams/{{ $exam->id }}.jpg">
            </a>
        </div>

        <br />

        <div class="col-md-4">

            <a href="/exams/download/{{ $exam->id }}" class="btn btn-success"><i class="fa fa-download"></i></a>

            @if (Auth::user())
                <a href="/solutions/{{ $exam->id }}/create" class="btn btn-primary"><i class="fa fa-plus"></i>&nbsp;&nbsp;Shto Zgjidhje</a>
            @endif

            @if (Auth::user() && Auth::user()->role != 1)
                <a href="/exams/delete/{{ $exam->id }}" class="btn btn-danger"><i class="fa fa-times"></i>&nbsp;&nbsp;Fshi Provimin</a>
            @endif

            @if(isset($solutions)&& $solutions->count())
                <div id="accordion">
                    @foreach( $solutions as $solution)
                        <h3 style="cursor: pointer; outline: none;" class="well well-sm">{{ $solution->title }} <i class="fa fa-caret-down"></i></h3>
                        <div>
                            <a target="_blank" href="/images/solutions/{{ $solution->id }}.jpg">
                                <img style="width: 100%;" src="/images/solutions/{{ $solution->id }}.jpg">
                            </a>
                            <p style="background-color: white; margin-top: 10px;">{{ $solution->body }}</p>
                        </div>
                    @endforeach
                </div>
            @endif

            <br />

            @if (Auth::user())
                <a style="width: 100%;" href="/exams/review/{{ $exam->id }}" class="btn btn-warning">Dërgo provimin për rishikim</a>
            @endif
        </div>
    </div>
@endsection
