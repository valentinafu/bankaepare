@extends('layouts.master')

@section('content')

    @if(isset($exams) && $exams->count())
        <div class='list-group gallery'>
            @foreach($exams as $exam)
                <div class='col-sm-4 col-xs-6 col-md-3 col-lg-3'>
                    <a class="thumbnail" href="/exams/{{ $exam->id }}">
                        <img class="img-responsive" alt="" src="/images/exams/{{ $exam->id }}.jpg" />
                    </a>
                </div>
            @endforeach
        </div>
    @endif

    <div class="row">
        @if(isset($subjects))
            <ul>
                @foreach($subjects as $subject)
                    <li><a href="/subjects/{{ $subject->id }}">{{ $subject->name }}</a></li>
                @endforeach
            </ul>
        @elseif(isset($degrees))
            <ul>
                @foreach($degrees as $degree)
                    <li><a href="/degrees/{{ $degree->id }}">{{ $degree->name }}</a></li>
                @endforeach
            </ul>
        @elseif(isset($faculties))
            @foreach($faculties as $faculty)
                <div class="col-md-4">
                    <div class="box box-studimi">
                        <a href="/faculties/{{ $faculty->id }}">
                            <p>{{ $faculty->name }}</p>
                            <img src="/images/{{ $faculty->id }}.jpg">
                        </a>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
@endsection
