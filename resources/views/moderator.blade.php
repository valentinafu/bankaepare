@extends('layouts.master')

@section('content')
    <div class="col-12 col-md-12">
        <div class="jumbotron">
            <h1>Hello, sheep master</h1><br/>

            <div>
                Ketu mund te kontrolloni fatet e sheep-eve. Ata jane nen meshiren tuaj.
                <table width="100%">
                    <tr>
                        <td><a href="/moderator/notifications">Notifications</a></td>
                        <td><a href="/admin/exams">Exams</a></td>
                    </tr>
                </table>
            </div>

        </div>

        @if(isset($notifications) && $notifications->count())
            <table border="2px solid black" style="min-width:700px; margin: 10px; background-color: #fff;">
                <th>Mesazhi</th>
                <th>Data</th>
                @foreach($notifications as $notification)
                    <tr>
                        <td style="padding: 10px;"><a href="{{ $notification->redirect }}">{{$notification->data}}</a></td>
                        <td style="padding: 10px;"> {{$notification->created_at}}</td>
                    </tr>
                @endforeach
            </table>
        @endif
    </div><!--/span-->
@endsection
