<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>fielsStudys</title>
    @include('menu')
</head>
<body>
    @foreach($fieldStudys as $fieldStudy)
        {{$fieldStudy -> name}}
        &nbsp&nbsp&nbsp&nbsp
        {{$fieldStudy -> university}}
        &nbsp&nbsp&nbsp&nbsp
        {{$fieldStudy -> college}}
        
        <a href="{{url('/fieldStudy/show/' . $fieldStudy -> id)}}">show</a>
        &nbsp&nbsp&nbsp&nbsp
        
        <a href="{{url('/fieldStudy/delete/' . $fieldStudy -> id)}}">delete</a>
        <br>
        <a href="{{url('/fieldStudy/masters/' . $fieldStudy -> id)}}"><h3>لیست اساتید   _{{$fieldStudy -> name}}_{{$fieldStudy -> university}}</h3></a>
        <br>
        <a href="{{url('/fieldStudy/fieldLessons/'. $fieldStudy -> id)}}"><h3>  نمایش دروس ارائه شده برای _{{$fieldStudy -> name}}_{{$fieldStudy -> university}}</h3> </a>
        
        <br><hr>

    @endforeach
</body>
</html>