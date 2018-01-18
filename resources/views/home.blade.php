@extends('layouts.master')

@section('custom_styles')
    @if(Request::is('/'))
        <link rel="stylesheet" type="text/css" href="/css/style.css">
    @endif
@endsection

@section('content')
    <div class="row">
        <div class="col-md-8">
            @if(isset($exams) && $exams->count())
                <div class="row">
                    @foreach($exams as $exam)
                        <div class="col-md-4">
                            <div class="thumbnail">
                                <a class="lightbox" href="/exams/{{ $exam->id }}">
                                    <img class="about-img" src="/images/exams/{{ $exam->id }}.jpg">
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @elseif(!isset($exams))
                @if(isset($subjects))
                    <div class="box-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Lëndët</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($subjects as $subject)
                                <tr>
                                    <td><a href="/subjects/{{ $subject->id }}">{{ $subject->name }}</a></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                @elseif(isset($degrees) && $degrees->count())
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
                @elseif(isset($faculties))
                    <div class="row">
                        @foreach($faculties as $faculty)
                            <div class="col-md-6">
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
        </div>
        <!-- Only if a user is logged in, the upload form is shown -->
        @if (Auth::user())
            <div class="col-md-4">
                <h3>Be a good student {{ Auth::user()->name }} and upload an exam here.</h3>
                <hr>

                <form action="{{ url('exams') }}" method="POST" enctype="multipart/form-data">
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

                    <div class="form-group">
                        <label for="faculty">Faculty</label>
                        <select class="form-control" name="faculty">
                            @if(isset($faculties) && $faculties->count())
                                @foreach($faculties as $faculty)
                                    <option value="{{ $faculty->id }}">{{ $faculty->name }}</option>
                                @endforeach
                            @else
                                <option value="1"> Fakulteti i Shkencave te Natyres</option>
                            @endif
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="degree">Degree</label>
                        <select class="form-control" name="degree">
                            @if(isset($degrees) && $degrees->count())
                                @foreach($degrees as $degree) // vektori dhe variabli
                                <option value="{{ $degree->id }}">{{ $degree->name }}</option>
                                @endforeach
                            @else
                                <option value="1"> Bachelor ne IMI</option>
                            @endif
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="subject">Subject</label>
                        <select class="form-control" name="subject">
                            @if(isset($subjects) && $subjects->count()) //cdo element i subjects eshte nje objekt (subject ->objekt)
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

                    @include ('layouts.errors')
                </form>
            </div>
        @endif
    </div>
@endsection
