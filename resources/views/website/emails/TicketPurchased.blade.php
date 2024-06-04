<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ticket Purchased</title>
</head>
<body>
    <div class="container">
        <div class="row mb-2 p-5" style=" background-color: aliceblue; border-radius: 10px; padding: 10px 10px 10px;">
            <h3>{{ $details['title'] }}</h3>
            <p>{!! $details['body'] !!}</p>
        </div>
        <div class="row mb-2 p-5" style=" background-color: aliceblue; border-radius: 10px; padding: 0px 10px 10px;">
            <p>If you Have any Query Please Contact <a href="mailto:{{env('WEBSITE_EMAIL')}}">{{env('WEBSITE_EMAIL')}}</a></p>
            <p>Regards, <br>
        </div>
    </div>
</body>
</html>
