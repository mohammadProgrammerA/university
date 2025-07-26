<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=\, initial-scale=1.0">
    <title>دروس ارائه شده این نیمسال برای {{$student -> name}}</title>
    @include('menu')
</head>
<body>
    

    
    
    @foreach($lessons as $lesson)
        <div>

            <p style ="background-color:pink;width:170px;float:right;">نام  درس : {{$lesson -> name}}</p>
            <p style ="background-color:red;width:170px;float:right;margin-right:15px;">تعداد واحد : {{$lesson -> unit}}</p>            
            <p style ="background-color:red;width:170px;float:right;margin-right:15px;">ترم : {{$lesson -> term}}</p>            
            
            <div style ="background-color:#0102;width:100px;margin-right:15px;margin-top:10px;">
                <b>
                    <a href="{{url('/lesson/show/' . $lesson -> id)}}">show</a>
                </b>
               
            </div>
            
       </div>
        <br><br><br><br>
    @endforeach
</body>
</html>