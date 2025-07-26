<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>single {{$student_datas["student_data"] -> name}}</title>
    @include('menu')
</head>
<body>
     <h1>this is a single student</h1>
     <h2>مشخصات و دانشگاه و رشته و دانشکده دانشجو  را میتوانید ببینید</h2>

     <div style="background-color:#0102;width:350px;height:100px;">
                <span>{{$student_datas ['student_data'] -> name}}</span>
                <p style="background-color:#0105;width:150px;margin-left:10px;"> ورودی  {{$student_datas["student_data"] -> year}}</p>
                <p style="background-color:#0105;width:150px;margin-left:20px;">code : {{$student_datas["student_data"] -> student_code}}</p>

      </div>



     @foreach($student_datas['uni'] as $uni_id => $uni)
      <p style="background-color:#0505;width:100px;height:30px;">{{$uni["uniData"] -> name}}</p>
      <p style="background-color:black;width:200px;color:white;"> {{$uni['status'] }}</p>

        @foreach($uni['colleges'] as $college_id => $college)
            <p style="background-color:#0902;width:100px;height:30px;margin-left:20px;">{{$college['college_data'] -> name}}</p>

            @foreach($college['field'] as $field_id => $field)
                <p style="background-color:gray;width:100px;height:30px;margin-left:40px;">{{$field["field_data"] -> name}}</p>
            @endforeach

        @endforeach
        <br><hr><br>
     @endforeach
      
      <br>
      <a href="http://localhost/laravel/university/public/student/profile">
        <li style="background-color:teal;width:150px;height:30px;color:white;">
        پروفایل دانشجو
        </li>
      </a>
      <a href="{{url('student/edite/'. $student_datas['student_data'] -> id)}}">  <p style="background-color:#0102;width:100px;color:green;">edit</p></a>
      <a href="{{url('student/delete/'. $student_datas['student_data'] -> id)}}">  <p style="background-color:#0204;width:100px;color:red;">delete</p></a>

       <a href="{{url('student/index')}}">  <p style="background-color:gray;width:313px;color:white;">  تمام دانشجویان هم رشته و هم ورودی</p></a>

   
</body>
</html>