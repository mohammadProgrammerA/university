<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>profile {{$student["student_data"] -> name}}</title>
    @include('menu')
</head>
<body>
    <hr><br>
     <h1 style="background-color:#0505;width:700px;height:50px;">this is a profile {{$student["student_data"] -> name}}</h1>
     <h3>{{$student["student_data"] -> name}}  مشخصات رشته ودانشگاه و دانشکده فعال</h3>
      <div  style="background-color:#0105;float:left;">
        
          <p style="background-color:white;width:100px;height:50px;float:left;">{{$student["uni"] -> name}}</p>
          <p style="background-color:white;width:100px;height:50px;margin-left:10px;float:left;">{{$student["college"] -> name}}</p>
          <p style="background-color:white;width:100px;height:50px;margin-left:15px;float:left;">{{$student["field"] -> name}}</p>
          <br><br><br><br>
            <div>
                <a href="{{url('student/edite/'. $student['student_data'] -> id)}}">  <p style="background-color:black;width:300px;color:red;margin-top:20px;">ادیت کردن رشته ودانشگاه بعد از مرحله ثبت نام</p></a>
                <a href="{{url('student/delete/'. $student['student_data'] -> id)}}">  <p style="background-color:red;width:300px;color:white;">می خواهم  از دانشگاه انصراف بدم delete</p></a>
            </div>
      </div>
      
     
      <div style="background-color:#0602;float:right;">
                <a href="{{url('student/selectUnit/'. $student['student_data'] -> id)}}">  <p style="background-color:olive;width:150px;height:50px;color:white;">انتخاب واحد تحصیلی </p></a>

                <a href="{{url('student/indexTerm/'. $student['student_data'] -> id)}}">  <p style="background-color:#0105;width:150px;color:red;">مشخصات تحصیلی </p></a>

                <a href="{{url('student/requests/'. $student['student_data'] -> id)}}">  <p style="background-color:teal;width:150px;color:white;height:50px;">درخواست ها </p>
            
                </a>

                <a href="{{url('student/showLessons/'. $student['student_data'] -> id)}}">  <p style="background-color:#0102;width:150px;color:green;"> دروس ارائه شده این ترم </p></a>
                <a href="{{url('student/studentUnits/'. $student['student_data'] -> id)}}">  <p style="background-color:pink;width:150px;"> دروس برداشت  شده دانشجو </p></a>
                <a href="{{url('student/editeUnit/'. $student['student_data'] -> id.'/number_term/'.$student['term'])}}">  <p style="background-color:hotpink;width:150px;"> حذف و اضافه ترم جاری</p></a>
      </div>
  
      
      <br>
      
      <br>


       
</body>
</html>