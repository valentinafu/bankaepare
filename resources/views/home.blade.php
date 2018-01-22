@extends('layouts.master')

@section('custom_styles')
    @if(Request::is('/'))
        <link rel="stylesheet" type="text/css" href="/css/style.css">
    @endif
@endsection

@section('content')
    <div class="row">
        @if (Auth::user())
            <?php $colValue = "col-md-8"; ?>
        @else
            <?php $colValue = "col-md-12"; ?>
        @endif
        <div class="{{ $colValue }}">
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
                @if(isset($subjects) && isset($showSubjects))
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
                @elseif(isset($degrees) && isset($showDegrees))
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
                @elseif(isset($faculties) && isset($showFaculties))
                    <div class="row">
                        @foreach($faculties as $faculty)
                            @if (Auth::user())
                                <?php $colValue = "col-md-6"; ?>
                            @else
                                <?php $colValue = "col-md-4"; ?>
                            @endif
                            <div class="{{ $colValue }}">
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
                <h3>Bëhu një student i mirë {{ Auth::user()->name }} dhe ngarko një provim këtu.</h3>
                {{--<h3>Be a good student {{ Auth::user()->name }} and upload an exam here.</h3>--}}
                <hr>

                <form action="{{ url('exams') }}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}

                    @if ($message = Session::get('success'))
                        <div class="alert alert-success alert-block" id="message">
                            <strong>{{ $message }}</strong>
                        </div>
                    @elseif ($message = Session::get('error'))
                        <div class="alert alert-danger alert-block" id="message">
                            <strong>{{ $message }}</strong>
                        </div>
                    @endif

                    <div class="form-group">
                        <label for="faculty">Fakulteti</label>
                        <select id="selectFaculty" class="form-control" name="faculty">
                            @if(isset($faculties) && $faculties->count())
                                @foreach($faculties as $faculty)
                                    @if(isset($currentFaculty) && $faculty->id == $currentFaculty->id)
                                        <option value="{{ $faculty->id }}" selected="selected">
                                            {{  $faculty->name }}
                                        </option>
                                    @else
                                        <option value="{{ $faculty->id }}">
                                            {{  $faculty->name }}
                                        </option>
                                    @endif
                                @endforeach
                            @else
                                <option value="1">Fakulteti i Shkencave të Natyrës</option>
                            @endif
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="degree">Dega</label>
                        <select id="selectDegree" class="form-control" name="degree">
                            @if(isset($degrees) && $degrees->count())
                                @foreach($degrees as $degree)
                                    @if(isset($currentDegree) && $degree->id == $currentDegree->id)
                                        <option value="{{ $degree->id }}" selected="selected">
                                            {{  $degree->name }}
                                        </option>
                                    @else
                                        <option value="{{ $degree->id }}">
                                            {{  $degree->name }}
                                        </option>
                                    @endif
                                @endforeach
                            @else
                                <option value="1">Bachelor në Inxhinieri Matematike dhe Informatike</option>
                            @endif
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="subject">Lënda</label>
                        <select id="selectSubject" class="form-control" name="subject">
                            @if(isset($subjects) && $subjects->count()) //cdo element i subjects eshte nje objekt (subject ->objekt)
                            @foreach($subjects as $subject)
                                @if(isset($currentSubject) && $subject->id == $currentSubject->id)
                                    <option value="{{ $subject->id }}" selected="selected">
                                        {{  $subject->name }}
                                    </option>
                                @else
                                    <option value="{{ $subject->id }}">
                                        {{  $subject->name }}
                                    </option>
                                @endif
                            @endforeach
                            @else
                                <option value="1">Analizë Matematike 1</option>
                            @endif
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="image">Imazh</label>
                        <input type="file" name="image" class="form-control">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success">Ngarko</button>
                    </div>

                    @include ('layouts.errors')
                </form>
            </div>
        @endif
    </div>

    @if($msg = Session::get('msg')))
    <div id="message" style="position: fixed; bottom: 0; right: 0; margin-bottom: 20px; margin-right: 10px; border-radius: 5px; padding: 20px; background-color: aqua; opacity: 0.8;">
        {{ $msg }}
    </div>
    @endif
@endsection
