<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>eite</title>
</head>
<body>
    <form action="{{url('student/subEdit')}}" >
        @csrf
        <input type="hidden" name="id" value="{{$student['student_data'] -> id}}">
        <input type="text" name ="name" value="{{$student['student_data'] ->name }}"><br>
        <input type="text" name ="student_code" value="{{ $student['student_data'] ->student_code}}"><br>
        <input type="text" name ="year" value="{{ $student['student_data'] ->year }}"><br><br>
        <select name="uni_id">
            <option >دانشکاه را انتخاب کن</option>
            @foreach($unis as $uni)
                <option value="{{$uni -> id}}" 
                    <?php
                        if($uni -> id ==$student["uni"] -> id){
                            echo "selected";
                        }
                    ?>
                >{{$uni -> name}}</option>
            @endforeach
        </select>
        <button type ="submit">submit</button>
    </form>
</body>
</html>