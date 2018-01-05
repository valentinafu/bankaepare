@extends('layouts.master')

@section('content')
    <div class="col-12 col-md-9">
        <p class="float-right d-md-none">
            <button type="button" class="btn btn-primary btn-sm" data-toggle="offcanvas">Toggle nav</button>
        </p>
        <div class="jumbotron">
            @if (Auth::guest())
                <h1>Hello, sheep.</h1>
            @else
                <h1>Hello, {{ Auth::user()->name }}</h1>
            @endif
        </div>
        <div class="row">
            <ul>
                @if(isset($subjects))
                    @foreach($subjects as $subject)
                        <li><a href="/subjects/{{ $subject->id }}">{{ $subject->name }}</a></li>
                    @endforeach
                @elseif(isset($degrees))
                    @foreach($degrees as $degree)
                        <li><a href="/degrees/{{ $degree->id }}">{{ $degree->name }}</a></li>
                    @endforeach
                @else
                    @foreach($faculties as $faculty)
                        <li><a href="/faculties/{{ $faculty->id }}">{{ $faculty->name }}</a></li>
                    @endforeach
                @endif
            </ul>
        </div><!--/row-->
    </div><!--/span-->
@endsection
