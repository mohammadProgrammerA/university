<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>colleges_fields</title>
    @include('menu')
</head>

<body>
    <h1>{{$college -> name}}</h1>
    <h2>دانشگاه  دارای دانشکده های زیر هست</h2>
    <h3> در هر دانشکده آورده شده رشته های تحصیلی آورده شده هست</h3>
 
    @foreach($collegesFields as $key => $collegesField)
            {{$collegesField}}
            <br>
            <a href="{{url('/fieldStudy/edite/' . $key)}}">edite</a>
            <br>
            <a href="{{url('/fieldStudy/show/' . $key)}}">show</a>
            <br>
           <a href="{{url('/fieldStudy/delete/' . $key)}}">delete</a>
            <br><br><hr><br><br>
    @endforeach
</body>
</html>