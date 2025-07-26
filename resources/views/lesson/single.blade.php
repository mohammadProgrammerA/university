<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>single_lesson</title>
</head>
<body>


    <div>
        <p style ="background-color:pink;width:250px;">نام  درس : {{$lesson -> name}}</p>
        <p style ="background-color:red;width:250px;margin-right:15px;">تعداد واحد : {{$lesson -> unit}}</p>
        <p style ="background-color:gray;width:250px;margin-right:15px;"> ارائه شده برای ترم : @if($lesson -> term == 0)  عمومی همه ترم ها@else {{$lesson -> term}}@endif</p>
        <p style ="background-color:violet;width:250px;margin-right:15px;">رشته  : {{$fieldStudy -> name}}</p>
        <p style ="background-color:blueviolet;width:250px;margin-right:15px;">دانشگاه : {{$university -> name}}</p>
    </div>

    

    edit : <a href="{{url('/lesson/edite/' . $lesson -> id)}}" style ="background-color:green;width:150px;margin-right:15px;color:red;">edite</a>
    delete : <a href="{{url('/lesson/delete/' . $lesson -> id)}}" style ="background-color:gray;width:150px;margin-right:15px;color:red;">delte</a>
        &nbsp&nbsp&nbsp&nbsp
</body>
</html>