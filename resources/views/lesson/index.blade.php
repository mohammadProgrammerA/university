<!DOCTYPE html>
<html lang="en">
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>lessons</title>
    @include('menu')
</head>
<body>
    @foreach($lessons as $lesson)
       <div>

            <p style ="background-color:pink;width:170px;float:right;">نام  درس : {{$lesson -> name}}</p>
            <p style ="background-color:red;width:170px;float:right;margin-right:15px;">تعداد واحد : {{$lesson -> unit}}</p>             <p style ="background-color:violet;width:170px;float:right;margin-right:15px;">رشته  : {{$lesson -> field}}</p>
            <p style ="background-color:blueviolet;width:170px;float:right;margin-right:15px;"> : {{$lesson -> university}}</p>
            <div style ="background-color:#0102;width:170px;margin-right:15px;margin-top:10px;">
                <b>
                    <a href="{{url('/lesson/show/' . $lesson -> id)}}">show</a>
                </b>
                &nbsp&nbsp
                <b>
                    <a href="{{url('/lesson/delete/' . $lesson -> id)}}">delete</a>
                </b>
                &nbsp&nbsp
                <b>
                    <a href="{{url('/lesson/edite/' . $lesson -> id)}}">edite</a>
                </b>
            </div>
            
       </div>
       <br><br><br><br>

        
        @endforeach
        <br><hr>
</body>
</html>