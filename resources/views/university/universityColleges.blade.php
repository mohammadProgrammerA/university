<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>universityColleges</title>پ
    @include('menu')
</head>
<body>
    <h1>{{$university -> name}}</h1>
    <h2>دانشگاه  دارای دانشکده های زیر هست</h2>
    <h3> در هر دانشکده آورده شده رشته های تحصیلی آورده شده هست</h3>
    @foreach($universitycolleges as $key => $universitycollege)
            {{$universitycollege}}
            <br>
            <a href="{{url('/college/show/' . $key)}}">show</a>
            <br>
            <a href="{{url('/college/edite/' . $key)}}">edite</a>
            <br>
            <a href="{{url('/college/delete/' . $key)}}">delete</a>
            <br><br><hr><br><br>
    @endforeach
</body>
</html>