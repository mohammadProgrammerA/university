<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>colleges</title>
    @include('menu')
</head>
<body>
    @foreach($colleges as $college)
        {{$college -> name}}
        {{$college -> university}}
        
        <a href="{{url('/college/show/' . $college -> id)}}">show</a>
        &nbsp&nbsp&nbsp&nbsp
        <a href="{{url('/college/edite/' . $college -> id)}}">edite</a>
        &nbsp&nbsp&nbsp&nbsp
        <a href="{{url('/college/delete/' . $college -> id)}}">delete</a>

        <br><hr>

    @endforeach
</body>
</html>