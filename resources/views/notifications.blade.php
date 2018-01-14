
<html>
<body>
<ul>

    @foreach($notifications as $notification)
        <li> {{$notification->type}}</li>
    @endforeach
</ul>
</body>
</html>