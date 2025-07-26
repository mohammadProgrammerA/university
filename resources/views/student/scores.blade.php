<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> scores{{$student["student_data"] -> name}}</title>
    @include('menu')
</head>
<body>
    <hr><br>
     <h1 style="background-color:gray;width:700px;height:50px;">enteringGrades {{$student["student_data"] -> name}}</h1>
     <h3>{{$student["student_data"] -> name}}  مشخصات رشته ودانشگاه و دانشکده فعال</h3>
     <h3>{{$student["term"]}}  ترم</h3>
     <h4>با فرض اینکه  اساتید دارن نمرات را وارد میکنند ثبت  نهایی میکنیم</h4>
      <div  style="background-color:#0105;float:left;">
        
          <p style="background-color:white;width:100px;height:50px;float:left;">{{$student["uni"] -> name}}</p>
          <p style="background-color:white;width:100px;height:50px;margin-left:10px;float:left;">{{$student["college"] -> name}}</p>
          <p style="background-color:white;width:100px;height:50px;margin-left:15px;float:left;">{{$student["field"] -> name}}</p>
          <br><br><br><br>
           
      </div>
        <br><br><br><br><br><br><br>
        <form action="{{url('student/enteringGradesStore')}}" method ="POST">
            @csrf
            
            @if(empty($allUnits))
                <h2>برای تر م{{$student["term"]}}   هنوز انتخاب واحد نشده است که نمره ای ثبت بشه باید انتخاب واحد بشه برو  </h2>
            @else
                @foreach($allUnits as $unit_id => $unit)
                    <div style="margin-top:30px;">
                        <div>
                            <p style="background-color:#0102;width:100px;height:40px;float:left;">{{$unit["lesson"] -> name}}</p>
                            <p style="background-color:gray;width:100px;height:40px;float:left;">{{$unit["master"] -> name}}</p>
                            <input type="text" name ="units[{{$unit_id}}]"  placeHolder="نمره را وارد کنید" >
                            <input type="hidden" name="student_id" value ="{{$student['student_data'] -> id}}" >
                            <!-- <input type="text" name = "score" value="{{$unit_id}}" > -->
                        </div>
                        
                            <br><br>
                    </div>
                
                @endforeach

            @endif
            <br><br>
            <button>ثبت  نهایی نمرات {{$student["student_data"] -> name}}  </button>
        </form>

     
      
      
      


       
</body>
</html>