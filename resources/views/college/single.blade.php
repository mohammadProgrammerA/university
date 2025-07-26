<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>single_college</title>
</head>
<body>
    
    <div ></span><span>university</span>&nbsp&nbsp<span>{{$university -> name}} {{$college -> name}} </div>
    <br>
    <a href="{{url('/college/show_fields/' . $college -> id)}}">لیست رشته های ارائه شده در دانشکده</a>
</body>
</html>