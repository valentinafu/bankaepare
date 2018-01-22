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

            @if (Auth::user() && (Auth::user()->role != 1) || Auth::user()->id == $exam->user->id)
                <a href="/exams/delete/{{ $exam->id }}" class="btn btn-danger"><i class="fa fa-trash"></i>&nbsp;&nbsp;Fshi Provimin</a>
            @endif

            @if(isset($solutions)&& $solutions->count())
                <div id="accordion">
                    @foreach( $solutions as $solution)
                        <h3 style="cursor: pointer; outline: none;" class="well well-sm">{{ $solution->title }} <i class="fa fa-caret-down"></i>
                            @if(Auth::user() && (Auth::user()->role != 1 || Auth::user()->id == $solution->user->id))
                                <span style="float: right;">
                                <a href="/solutions/delete/{{ $solution->id }}" class="btn btn-danger btn-sm">
                                    <i class="fa fa-trash"></i>
                                </a>
                                </span>
                            @endif
                        </h3>
                        <div>
                            <a target="_blank" href="/images/solutions/{{ $solution->id }}.jpg">
                                <img style="width: 100%;" src="/images/solutions/{{ $solution->id }}.jpg">
                            </a>
                            <?php echo '<div style="margin-top: 10px;">' . str_replace("\r\n", "<br />", $solution->body) . '</div>'; ?>
                        </div>
                    @endforeach
                </div>
            @endif

            @if (Auth::user() && Auth::user()->role != 2)
                <a style="width: 100%; margin-top: 15px;" href="/exams/review/{{ $exam->id }}" class="btn btn-warning">Dërgo provimin për rishikim</a>
            @endif
        </div>
    </div>

    @if($msg = Session::get('msg'))
    <div id="message" style="position: fixed; bottom: 0; right: 0; margin-bottom: 20px; margin-right: 10px; border-radius: 5px; padding: 20px; background-color: aqua; opacity: 0.8;">
        {{ $msg }}
    </div>
    @endif
@endsection
