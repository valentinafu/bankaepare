@extends('layouts.master')

@section('custom_styles')
    <link rel="stylesheet" type="text/css" href="/css/style.css">
@endsection

@section('content')
    <div class="row">
        <div class="col-12 col-md-12">
            <div class="jumbotron">
                <nav class="navbar" style="background-color: #0c96a1; margin-bottom: 0px;">
                    <table style="text-align: center; width: 100%; height: 50px;">
                        <tr>
                            <td style="valign: middle;
                            @if(Request::is('moderator'))
                                    background-color: #034651
                            @endif
                                    "width="33%"><a href="/moderator"><span style="color: white; font-size: 16px;">Njoftimet</span></a></td>
                            <td style="valign: middle;
                            @if(Request::is('moderator/exams'))
                                    background-color: #034651
                            @endif
                                    "width="33%"><a href="/moderator/exams"><span style="color: white; font-size: 16px;">Provimet</span></a></td>
                        </tr>
                    </table>
                </nav>
            </div>

            @if(isset($notifications) && $notifications->count())
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>Njoftimi</th>
                            <th>Data</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($notifications as $notification)
                            <tr>
                                <td><a href="{{ $notification->redirect }}">{{$notification->data}}</a></td>
                                <td>{{$notification->created_at}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @elseif(isset($exams) && $exams->count())
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>Fakultet</th>
                            <th>Dega</th>
                            <th>Lënda</th>
                            <th>Ngarkuar në</th>
                            <th>Shiko</th>
                            <th>Fshi</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($exams as $exam)
                            <tr>
                                <td style="padding: 10px;"> {{$exam->subject->degree->faculty->name}}</td>
                                <td style="padding: 10px;"> {{$exam->subject->degree->name}}</td>
                                <td style="padding: 10px;"> {{$exam->subject->name}}</td>
                                <td style="padding: 10px;"> {{$exam->created_at}}</td>
                                <td style="padding: 10px;"><a href="/exams/{{ $exam->id }}" class="btn btn-primary"><i class="fa fa-eye"></i></a></td>
                                <td style="padding: 10px;"><a href="/exams/delete/{{ $exam->id }}" class="btn btn-danger"><i class="fa fa-trash"></i></a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div><!--/span-->
    </div>
@endsection
