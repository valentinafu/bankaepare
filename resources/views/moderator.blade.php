@extends('layouts.master')

@section('content')
    <div class="col-12 col-md-12">
        <p class="float-right d-md-none">
            <button type="button" class="btn btn-primary btn-sm" data-toggle="offcanvas">Toggle nav</button>
        </p>
        <div class="jumbotron">
            <h1>Hello, sheep master</h1><br/>

            <div>
                Ketu mund te kontrolloni fatet e sheep-eve. Ata jane nen meshiren tuaj.
            </div>
            <table border="2px solid black" style="min-width:700px; margin: 10px; background-color: #fff;">
                <th colspan="4" style="padding: 10px; background-color: #f2f2ef;"> Moderator Privileges</th>
                <tr >
                    <td style="padding: 10px;"><input type = "checkbox"> view_users</td>
                    <td style="padding: 10px;"><input type = "checkbox"> add_users</td>
                    <td style="padding: 10px;"><input type = "checkbox"> edit_users</td>
                    <td style="padding: 10px;"><input type = "checkbox"> delete_users</td>
                </tr>
                <tr >
                    <td style="padding: 10px;"><input type = "checkbox"> view_roles</td>
                    <td style="padding: 10px;"><input type = "checkbox"> edit_roles</td>
                    <td style="padding: 10px;"><input type = "checkbox"> delete_roles</td>
                </tr>
                <tr >
                    <td style="padding: 10px;"><input type = "checkbox"> view_posts</td>
                    <td style="padding: 10px;"><input type = "checkbox"> add_posts</td>
                    <td style="padding: 10px;"><input type = "checkbox"> edit_posts</td>
                    <td style="padding: 10px;"><input type = "checkbox"> delete_posts</td>
                </tr>
            </table>
        </div>


    </div><!--/span-->
@endsection
