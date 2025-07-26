<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>show students </title>
    @include('menu')

</head>
<body>
    @if(empty($allData))
    
    <h1>دانشجویی نیست</h1>
    @else 
        @foreach($allData as $student)
            <div style="background-color:#0102;width:350px;">
                <span>{{$student ['student_data'] -> name}}</span>
                <p style="background-color:#0105;width:150px;margin-left:10px;"> ورودی  {{$student ['student_data'] -> year}}</p>
                <p style="background-color:#0105;width:150px;margin-left:20px;">code : {{$student ['student_data'] -> student_code}}</p>

                @foreach($student['uni'] as $uni_id => $uni)
                     <p style="background-color:#0102;width:313px;"> {{$uni['uniData'] -> name}}</p>
                     
                     
                     @foreach($uni['colleges'] as $college_id => $college)
                        <p style="background-color:pink;width:200px;margin-left:50px;">{{$college ['college_data'] -> name}}</p>
                        @foreach($college['field'] as $field_id => $field)
                            
                            <p style="background-color:#0105;width:150px;margin-left:100px;">{{$field["field_data"] -> name}}</p>


                        @endforeach
                     @endforeach
                     
                     <p style="background-color:red;width:200px;color:yellow;height:50px;"> {{$uni['status'] }}</p>
                     <br><hr><br>
                @endforeach
                <br>
        <a href="http://localhost/laravel/university/public/student/profile">
            <li style="background-color:teal;width:150px;height:30px;color:white;">
            پروفایل دانشجو
            </li>
        </a>
                <a href="{{url('student/edite/'. $student['student_data'] -> id)}}">  <p style="background-color:green;width:220px;color:red;">edit  در فعال</p></a>
                <a href="{{url('student/show/'. $student['student_data'] -> id)}}">  <p style="background-color:white;width:220px;color:red;">single در  همه دانشکاه </p></a>
                <a href="{{url('student/delete/'. $student['student_data'] -> id)}}">  <p style="background-color:red;width:220px;color:white;"> در دانشگاه فعالdelete</p></a>

            </div>
            <br><br><br>
  
        @endforeach
    @endif
</body>
</html>