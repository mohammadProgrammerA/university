<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>select majore for  {{$student["name"]}}</title>
    @include('menu')

    <form action="{{url('student/store')}}" method="POST">
        @csrf
        <input type="hidden" name="name" value="{{$student['name']}}">
        <input type="hidden" name="student_code" value="{{$student['student_code']}}">
        <input type="hidden" name="year" value="{{$student['year']}}">
        @foreach($allData as $uni_id =>  $colleges)
        
        <p style ="background-color:#0101;width:150px;"> {{$colleges["uni_data"] -> name}}</p>
        <input type="hidden" name="uni_id" value="{{$colleges['uni_data'] -> id}}">
        @foreach($colleges["colleges"] as $college_id => $college)
                    <p style ="background-color:#0103;width:150px;margin-left:50px;">{{$college['college_data'] -> name}} <input type="checkbox" name="college" value="{{$college_id}}"></p>
                    @foreach($college['fields'] as $field_id => $field)
                        <p style ="background-color:#0506;width:150px;margin-left:100px;">{{$field -> name}} <input type="checkbox" name="field" value="{{$field_id}}"></p>
                    @endforeach
            @endforeach

   
        @endforeach

        <br>
        <button type ="submit">submit</button>
    </form>
</head>
<body>
    
</body>
</html>