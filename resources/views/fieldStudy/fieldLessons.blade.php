<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>feildslessons</title>
    @include("menu")
</head>
<body>
    <h1>دروس ارائه شده برای رشته دانشگاه</h1>
        {{$field -> name}}
        {{$university -> name}}
        <br>
        <hr>
        <h3>دارای دروس زیر هست</h3>

     
        
        
        
        @foreach($lessons_field as $lesson_field)
        <p style ="background-color:pink;width:200px;float:right;">نام  درس : {{$lesson_field ["lesson"] -> name}}</p>
        <p style ="background-color:red;width:200px;float:right;margin-right:15px;">تعداد واحد : {{$lesson_field ["lesson"] -> unit}}</p>
        <p style ="background-color:gray;width:150px;float:right;margin-right:15px;"> ارائه شده برای ترم :  {{$lesson_field ["lesson"] -> term}}</p>
        <p style ="background-color:violet;width:180px;float:right;margin-right:15px;"> دانشگاه: {{$lesson_field -> university}}</p>
        <p style ="background-color:blueviolet;width:220px;float:right;margin-right:15px;"> دانشکده:  {{$lesson_field -> college}}</p>
            
           
            
            

            <a href="{{url('/lesson/edite/'.$lesson_field -> lesson_id)}}">edite</a>&nbsp &nbsp &nbsp
            <a href="{{url('/lesson/delete/' .$lesson_field -> lesson_id )}}">delete</a>&nbsp &nbsp &nbsp
            <a href="{{url('/lesson/show/' .$lesson_field -> lesson_id)}}">show</a>


            <br><hr><br>
        @endforeach
</body>
</html>