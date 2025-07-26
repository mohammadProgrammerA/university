<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> حذف و اضافه  {{$student -> name}}</title>
    @include('menu')
</head>
<body>
    <h1>حذف و اضافه  برای {{$student -> name}}</h1>
    
    
 
    <br><br>


    <form action="{{url('student/updateUnite')}}" method="POST">

    @csrf

    <input type="hidden" name="student_id" value="{{$student -> id}}">
    <input type="hidden" name="term_number" value="{{$student -> term}}">

    @foreach($lesson_teachers as $lesson_id => $lesson_teacher)
       <p style="background-color:#0605;width:200px;">{{$lesson_teacher['lesson'] -> name}} 

            <input type="checkbox" name="unis[lesson][{{$lesson_teacher['lesson'] -> id}}]" 
            
                 <?php foreach($editeUnits as $lessonId => $masterId){if($lesson_teacher['lesson'] -> id == $lessonId ){echo "checked";}}?>
            
            >

       </p>

       @if(empty($lesson_teacher['mastters']))
                 <p style="background-color:#0102;width:200px;margin-left:50px;">استادی هنوز برای این درس نیست</p>
       @else
            @foreach($lesson_teacher['mastters'] as $master_id => $master)
            
                        <p style="background-color:#0102;width:200px;margin-left:50px;">{{$master -> name }} 
                            
                            <input type="checkbox" name="unis[master][{{$lesson_teacher['lesson'] -> id}}][{{$master -> id}}]"
                                <?php foreach($editeUnits as $lessonId => $masterId){if($master_id == $masterId && $lesson_id == $lessonId){echo "checked";}}?>
                            >
                        
                        </p>
            @endforeach

        @endif
    @endforeach

    <button type ="submit">save_unis</button>
    </form>

    
    
</body>
</html>