<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>single _ university</title>
</head>
<body>
    
    <div> university:  {{$university -> name}}</div>
    
    

    

    <a href="{{url('/university/edite/' . $university -> id)}}">edite</a>
    <br><br>
    <a href="{{url('/university/show_colleges/' . $university -> id)}}">لیست دانشکده های دانشکاه</a>
        &nbsp&nbsp&nbsp&nbsp
</body>
</html>