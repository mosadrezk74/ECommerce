<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    @foreach($notifications as $notification)
    div class=notification {{ $notification-read()  'read'  'unread' }}
        p{{ $notification-data['message'] }}p
        small{{ $notification-created_at-diffForHumans() }}small
        @if(!$notification-read())
            form action={{ route('notifications.read', $notification-id) }} method=POST
                @csrf
                button type=submit class=btn btn-sm btn-primaryتمييز كمقروءbutton
            form
        @endif
    div
@endforeach
</body>
</html>

