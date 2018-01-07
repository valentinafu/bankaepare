@extends('layouts.master')

@section('content')
    <div class="col-12 col-md-9">
        <div class="row">
            <a href="/images/exams/{{ $exam->id }}.jpg">
                <img class="img-responsive"
                     style="margin: 0 auto;width:100%; height:100%;"
                     alt="Vari Lesht" src="/images/exams/{{ $exam->id }}.jpg" />
            </a>
        </div><!--/row-->
    </div><!--/span-->

    <div class="col-6 col-md-3 sidebar-offcanvas" id="sidebar">
        <div class="list-group">
            @if(isset($solutions)&& $solutions->count())
                @foreach( $solutions as $solution)
                    <a href="#" class="list-group-item">{{ $solution->title }}</a>
                    <img src="/images/solutions/{{ $solution->id }}.jpg" width="100" height="100">
                @endforeach
            @endif
            <a href="/solutions/{{ $exam->id }}/create" class="list-group-item">Add Solution</a>
        </div>
    </div><!--/span-->
@endsection
