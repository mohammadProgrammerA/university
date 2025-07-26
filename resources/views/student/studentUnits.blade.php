<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>studentUnits {{$student -> name}}</title>
    @include('menu')
</head>
<body>
    @if(empty($allUnits))

        <h1>دانشجو هنوز انتخاب واحد نکرده است</h1>
        <h2>انتخاب واحد از لینک زیر</h2>
        <a href="{{url('student/selectUnit/'. $student -> id)}}">  انتخاب واحد </a>
    
    @else
    
    <h1>لیست دروس برداشته {{$student -> name}} در هر ترم</h1>

    <br><br>


        @foreach($allUnits as $number_term => $unit)
        <p style="background-color:#0102;width:100px;margin-top:20px;"> لیست دروس ترم{{$number_term}}</p>
            @foreach($unit["lessons"] as $lesson_id => $lesson)
            <p style="background-color:#0604;width:100px;margin-top:20px;margin-left:72px;">{{$lesson['lesson_data'] -> name}}</p>
            <p style="background-color:#0604;width:150px;margin-top:20px;margin-left:140px;"> master : {{$lesson['master'] -> name}}</p>
                
            @endforeach
         <a href="{{url('student/editeUnit/'.$student ->id .'/number_term/'.$number_term )}}">  <p style="background-color:hotpink;width:150px;"> حذف و اضافه ترم {{$number_term }}</p></a>
        @endforeach

    @endif
</body>
</html>