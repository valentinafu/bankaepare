@extends('layouts.master')

@section('content')
    <div class="col-12 col-md-12">
        <p class="float-right d-md-none">
            <button type="button" class="btn btn-primary btn-sm" data-toggle="offcanvas">Toggle nav</button>
        </p>
        <div class="jumbotron">
            @if (Auth::guest())
                <h1>Hello, sheep.</h1>
            @else
                <h1>Hello, {{ Auth::user()->name }}</h1>
            @endif

            <!-- Only if a user is logged in, the upload form is shown -->
            @if (Auth::user())

                <h3>Be a good student {{ Auth::user()->name }} and upload an exam here.</h3>
                <hr>

                <form action="{{ url('exams') }}" class="form-image-upload" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}

                    @if ($message = Session::get('success'))
                        <div class="alert alert-success alert-block">
                            <strong>{{ $message }}</strong>
                        </div>
                    @endif

                    <div class="row">
                        <div class="form-group">
                        <label for="subject">Subject</label>
                        <select class="form-control" name="subject">
                            @if(isset($subjects) && $subjects->count())
                                @foreach($subjects as $subject)
                                    <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                                @endforeach
                            @else
                                <option value="1">Analizë Matematike 1</option>
                            @endif
                        </select>
                    </div>
                        <div class="form-group">
                            <label for="image">Exam Image:</label>
                            <input type="file" name="image" class="form-control">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success">Upload</button>
                        </div>
                    </div>

                    @include ('layouts.errors')
                </form>
            @endif

        </div>

        <div class="row">
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
            <ul>
                @if(isset($subjects))
                    @foreach($subjects as $subject)
                        <li><a href="/subjects/{{ $subject->id }}">{{ $subject->name }}</a></li>
                    @endforeach
                @elseif(isset($degrees))
                    @foreach($degrees as $degree)
                        <li><a href="/degrees/{{ $degree->id }}">{{ $degree->name }}</a></li>
                    @endforeach
                @elseif(isset($faculties))
                    @foreach($faculties as $faculty)
                        <li><a href="/faculties/{{ $faculty->id }}">{{ $faculty->name }}</a></li>
                    @endforeach
                @endif
            </ul>
        </div><!--/row-->
    </div><!--/span-->
@endsection
