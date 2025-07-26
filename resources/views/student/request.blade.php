<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>درخواست های {{$student -> name}}</title>
    @include('menu')
    <h1>درخواست های {{$student -> name}}</h1>
</head>
<body>
    
    <a href="{{url('student/transfer/'. $student -> id)}}">  <p style="background-color:#DEB887;width:220px;height:40px;"> ثبت انتفالی {{$student -> name}}</p></a>
    <a href="{{url('student/result_requests/'. $student -> id)}}">  <p style="background-color:#0103;width:220px;height:40px;">  نتیجه درخواست های {{$student -> name}}</p></a>
    <a href="{{url('student/leave/'. $student -> id)}}">  <p style="background-color:gray;width:340px;height:40px;color:white;">  در ترم جاری{{$student -> name}} درخواست مرخصی </p></a>

</body>
</html>