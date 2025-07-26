<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>enteringGrades student</title>
    @include("menu")
</head>
<body>
    <form action="{{url('student/enteringGrades')}}" method ="POST">
        @csrf
        <input type="text" name ="student_code" placeHolder="برای وارد کردن نمرات  شماره دانشجویی را بزنید">
        <br><br>
        <button type ="submit">submit</button>
    </form>
</body>
</html>