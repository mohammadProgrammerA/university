<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>انتخاب واحد برای {{$student -> name}}</title>
    @include('menu')
</head>
<body>
   
    @if(empty($lesson_teachers))
        <h1>هنوز درسی برای این رشته ارائه نشده هست</h1>
    @endif
    @if($lesson_teachers=="dontSetUnit")
       <h1>شما قبلا برای این ترم انتخاب واحد کردین </h1>
       <h1>در زمان حذف و اضافه ادیت کن</h1>>
    @else
        <bdi dir="rtl">این دانشجو ترم <span>{{$student["number_term"]}}</span>{{$student["term"]}} است پس دروس مربوطه برای این ترم میاد</bdi>
        <br><br>


        <form action="{{url('student/storeUnits')}}" method="POST">
        @csrf

        <input type="hidden" name="student_id" value="{{$student -> id}}">

        @foreach($lesson_teachers as $lesson_id => $lesson_teacher)
        <p style="background-color:#0605;width:200px;">{{$lesson_teacher['lesson'] -> name}} <input type="checkbox" name="unis[lesson][{{$lesson_teacher['lesson'] -> id}}]"></p>

            @if(empty($lesson_teacher['mastters']))
                    <p style="background-color:#0102;width:200px;margin-left:50px;">استادی هنوز برای این درس نیست</p>
            @else
                @foreach($lesson_teacher['mastters'] as $master_id => $master)
                            <p style="background-color:#0102;width:200px;margin-left:50px;">{{$master -> name }} <input type="checkbox" name="unis[master][{{$lesson_teacher['lesson'] -> id}}][{{$master -> id}}]"></p>
                @endforeach
            @endif
        @endforeach
    @endif
        <button type ="submit">save_unis</button>
        </form>

   
    
</body>
</html>