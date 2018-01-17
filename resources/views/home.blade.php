@extends('layouts.master')

@section('content')

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
            @elseif ($message = Session::get('error'))
                <div class="alert alert-danger alert-block">
                    <strong>{{ $message }}</strong>
                </div>
            @endif

            <div class="row">
                @if(isset($subject))
                @endif
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
    @elseif(!isset($exams))
        @if(isset($subjects))
            <ul>
                @foreach($subjects as $subject)
                    <li><a href="/subjects/{{ $subject->id }}">{{ $subject->name }}</a></li>
                @endforeach
            </ul>
        @elseif(isset($degrees) && $degrees->count())
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">{{ $degrees[0]->faculty->name }}</h3>
                </div>
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>Degët</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($degrees as $degree)
                            <tr>
                                <td><a href="/degrees/{{ $degree->id }}">{{ $degree->name }}</a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @elseif(isset($faculties))
            <div class="row">
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
            </div>
        @endif
    @endif
@endsection
