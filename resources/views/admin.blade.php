@extends('layouts.master')

@section('custom_styles')
    <link rel="stylesheet" type="text/css" href="/css/style.css">
@endsection

@section('content')
    <div class="col-12 col-md-12">
        <div class="jumbotron">
            <h3>Përshëndetje {{Auth::user()->name}}</h3><br/>

            <div>
                Këtu mund të kontrolloni userat dhe modertorët .
                <table width="100%">
                    <tr>
                        <td><a href="/admin/users">Usera</a></td>
                        <td><a href="/admin">Moderatorë</a></td>
                        <td><a href="/admin/exams">Provime</a></td>
                    </tr>
                </table>
            </div>

        </div>

        @if(isset($users) && $users->count())
            <table border="2px solid black" style="min-width:700px; margin: 10px; background-color: #fff;">
                <th>Emër</th>
                <th>Email</th>
                <th>Aktiv</th>
                <th>Roli</th>
                <th>Ç'aktivizo</th>
                @foreach($users as $user)
                    <tr>
                        <td style="padding: 10px;"> {{$user->name}} </td>
                        <td style="padding: 10px;"> {{$user->email}} </td>
                        <td style="padding: 10px;"> {{$user->active}} </td>
                        <td style="padding: 10px;"><a href="/users/edit/{{ $user->id }}">Bëj moderator</a></td>
                        @if ($user->active == 1)
                            <?php $message = "Ç'aktivizo"; ?>
                        @else
                            <?php $message = "Aktivizo"; ?>
                        @endif
                        <td style="padding: 10px;"><a href="/users/activate/{{ $user->id }}">{{ $message }}</a></td>
                    </tr>
                @endforeach
            </table>
            @elseif(isset($moderators) && $moderators->count())
                <table border="2px solid black" style="min-width:700px; margin: 10px; background-color: #fff;">
                    <th>Emër</th>
                    <th>Email</th>
                    <th>Aktiv</th>
                    <th>Roli</th>
                    @foreach($moderators as $moderator)
                        <tr>
                            <td style="padding: 10px;"> {{$moderator->name}} </td>
                            <td style="padding: 10px;"> {{$moderator->email}} </td>
                            <td style="padding: 10px;"> {{$moderator->active}} </td>
                            <td style="width: 100%; border-radius:0px;padding: 10px;" class="btn btn-primary">Hiq të drejtat e moderatorit</td>
                        </tr>
                    @endforeach
                </table>
        @elseif(isset($exams) && $exams->count())
            <table border="2px solid black" style="min-width:700px; margin: 10px; background-color: #fff;">
                <th>Fakultet</th>
                <th>Dega</th>
                <th>Lënda</th>
                <th>Shiko</th>
                <th>Fshi</th>
                @foreach($exams as $exam)
                    <tr>
                        <td style="padding: 10px;"> {{$exam->subject->degree->faculty->name}}</td>
                        <td style="padding: 10px;"> {{$exam->subject->degree->name}}</td>
                        <td style="padding: 10px;"> {{$exam->subject->name}}</td>
                        <td style="padding: 10px;"><a href="/exams/{{ $exam->id }}">View</a></td>
                        <td style="padding: 10px;"><a href="/exams/delete/{{ $exam->id }}">Delete</a></td>
                    </tr>
                @endforeach
            </table>
        @endif
    </div><!--/span-->
@endsection
