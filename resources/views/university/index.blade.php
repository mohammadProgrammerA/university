<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>universitys</title>
    @include('menu')
</head>
<body>
    @foreach($universitys as $university)
        {{$university -> name}}
        
        <a href="{{url('/university/show/' . $university -> id)}}">show</a>
        &nbsp&nbsp&nbsp&nbsp
        <a href="{{url('/university/edite/' . $university -> id)}}">edite</a>
        &nbsp&nbsp&nbsp&nbsp
        <a href="{{url('/university/delete/' . $university -> id)}}">delete</a>

        <br><hr>

    @endforeach
</body>
</html>