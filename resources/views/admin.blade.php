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
                            @if(Request::is('admin/users'))
                                    background-color: #034651
                            @endif
                                    "width="33%"><a href="/admin/users"><span style="color: white; font-size: 16px;">Përdoruesit</span></a></td>
                            <td style="valign: middle;
                            @if(Request::is('admin'))
                                    background-color: #034651
                            @endif
                                    "width="33%"><a href="/admin"><span style="color: white; font-size: 16px;">Moderatorët</span></a></td>
                            <td style="valign: middle;
                            @if(Request::is('admin/exams'))
                                    background-color: #034651
                            @endif
                                    "width="33%"><a href="/admin/exams"><span style="color: white; font-size: 16px;">Provimet</span></a></td>
                        </tr>
                    </table>
                </nav>
            </div>

            @if(isset($users) && $users->count())
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>Emër</th>
                            <th>Email</th>
                            <th>Aktiv</th>
                            <th>Roli</th>
                            <th>Ç'aktivizo</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td style="padding: 10px;"> {{$user->name}} </td>
                                <td style="padding: 10px;"> {{$user->email}} </td>
                                <td style="padding: 10px;"> {{$user->active ? "Po" : "Jo"}} </td>
                                <td style="padding: 10px;"><a href="/users/toggleMod/{{ $user->id }}">Kthe në Moderator</a></td>
                                @if ($user->active == 1)
                                    <?php $message = "Ç'aktivizo"; ?>
                                @else
                                    <?php $message = "Aktivizo"; ?>
                                @endif
                                <td style="padding: 10px;"><a href="/users/activate/{{ $user->id }}">{{ $message }}</a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @elseif(isset($moderators) && $moderators->count())
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>Emër</th>
                            <th>Email</th>
                            <th>Aktiv</th>
                            <th>Roli</th>
                            <th>Ç'aktivizo</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($moderators as $moderator)
                            <tr>
                                <td style="padding: 10px;"> {{$moderator->name}} </td>
                                <td style="padding: 10px;"> {{$moderator->email}} </td>
                                <td style="padding: 10px;"> {{$moderator->active ? "Po" : "Jo"}} </td>
                                <td style="padding: 10px;"><a href="/users/toggleMod/{{ $moderator->id }}">Hiq të drejtat e moderatorit</a></td>
                                @if ($moderator->active == 1)
                                    <?php $message = "Ç'aktivizo"; ?>
                                @else
                                    <?php $message = "Aktivizo"; ?>
                                @endif
                                <td style="padding: 10px;"><a href="/users/activate/{{ $moderator->id }}">{{ $message }}</a></td>
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

    @if($msg = Session::get('msg')))
    <div id="message" style="position: fixed; bottom: 0; right: 0; margin-bottom: 20px; margin-right: 10px; border-radius: 5px; padding: 20px; background-color: aqua; opacity: 0.8;">
        {{ $msg }}
    </div>
    @endif
@endsection
