@extends('layouts.master')

@section('custom_styles')
    <link rel="stylesheet" type="text/css" href="/css/style.css">
    <style>
        .special-class {
            width: 100%;
            margin: 0 auto;
        }

        @media screen and (min-width: 767px) {
            .special-class {
                width: 50%;
            }
        }
    </style>
@endsection

@section('content')
    <div class="row special-class"">
    <div class="col-12 col-md-12">
        <div class="jumbotron">

            <!-- Only if a user is logged in, the upload form is shown -->
            @if (Auth::user())

                <h3>Ngarkoni një zgjidhje në lëndën {{ $exam->subject->name }}</h3>
                <hr>
                <form action="{{ url('solutions/store') }}" class="form-image-upload" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}

                    <div class="row">
                        <input type="hidden" name="exam" value="{{ $exam->id }}">
                        <div class="form-group">
                            <label for="title">Ushtrimi:</label>
                            <input type="text" name="title" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="image">Zgjidhja (Imazh):</label>
                            <input type="file" name="image" class="form-control">
                        </div>

                        <label for="solution">Zgjidhja (Tekst):</label>
                        <div class="form-group">
                            <textarea name ="body" style="width:100%;" rows="6"></textarea>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success">Ngarko</button>
                        </div>
                    </div>

                    @include ('layouts.errors')
                </form>
            @endif

        </div>
    </div><!--/span-->
    </div>
@endsection
