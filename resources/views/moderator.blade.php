@extends('layouts.master')

@section('custom_styles')
    <link rel="stylesheet" type="text/css" href="/css/style.css">
@endsection

@section('content')
    <div class="row">
    <div class="col-12 col-md-12">
        <div class="jumbotron">
            <h1>Hello, sheep master</h1><br/>

            <div>
                Ketu mund te kontrolloni fatet e sheep-eve. Ata jane nen meshiren tuaj.
            </div>

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
        @endif
    </div><!--/span-->
    </div>
@endsection
