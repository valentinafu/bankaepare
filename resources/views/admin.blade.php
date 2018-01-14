@extends('layouts.master')

@section('content')
    <div class="col-12 col-md-12">
        <div class="jumbotron">
            <h1>Hello, sheep master</h1><br/>

            <div>
                Ketu mund te kontrolloni fatet e sheep-eve. Ata jane nen meshiren tuaj.
                <table width="100%">
                    <tr>
                        <td><a href="/admin/users">Ordinary Sheep</a></td>
                        <td><a href="/admin">Moderator Sheep</a></td>
                        <td><a href="/admin/exams">Exams</a></td>
                    </tr>
                </table>
            </div>

        </div>

        @if(isset($users) && $users->count())
            <table border="2px solid black" style="min-width:700px; margin: 10px; background-color: #fff;">
                <th>Name</th>
                <th>Email</th>
                <th>Active</th>
                <th>Edit</th>
                <th>Deactivate</th>
                @foreach($users as $user)
                    <tr>
                        <td style="padding: 10px;"> {{$user->name}} </td>
                        <td style="padding: 10px;"> {{$user->email}} </td>
                        <td style="padding: 10px;"> {{$user->active}} </td>
                        <td style="padding: 10px;"><a href="/users/edit/{{ $user->id }}">Edit User</a></td>
                        <td style="padding: 10px;"><a href="/users/deactivate/{{ $user->id }}">Deactivate User</a></td>
                    </tr>
                @endforeach
            </table>
            @elseif(isset($moderators) && $moderators->count())
                <table border="2px solid black" style="min-width:700px; margin: 10px; background-color: #fff;">
                    <th>Name</th>
                    <th>Email</th>
                    <th>Active</th>
                    <th>Edit</th>
                    <th>Deactivate</th>
                    @foreach($moderators as $moderator)
                        <tr>
                            <td style="padding: 10px;"> {{$moderator->name}} </td>
                            <td style="padding: 10px;"> {{$moderator->email}} </td>
                            <td style="padding: 10px;"> {{$user->active}} </td>
                            <td style="padding: 10px;"><a href="/users/edit/{{ $moderator->id }}">Edit Moderator</a></td>
                            <td style="padding: 10px;"><a href="/users/deactivate/{{ $moderator->id }}">Deactivate Moderator</a></td>
                        </tr>
                    @endforeach
                </table>
        @elseif(isset($exams) && $exams->count())
            <table border="2px solid black" style="min-width:700px; margin: 10px; background-color: #fff;">
                <th>Faculty</th>
                <th>Degree</th>
                <th>Subject</th>
                <th>View</th>
                <th>Delete</th>
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
