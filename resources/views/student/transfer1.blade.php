<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>transfer {{$student -> name}}</title>
    @include('menu')
</head>
<body>
    <form action="{{url('student/transfer2')}}" method ="POST">
        @csrf
        <input type="text" value="{{$student -> uni -> name}}">
        <input type="hidden" name="nowUni" value="{{$student -> uni -> id}}">
        <input type="hidden" name="student_id" value="{{$student -> id}}">
        <br><br>

       
        <select name="nextUni">
            <option >دانشکاه مقصد را انتخاب کن</option>
            @foreach($unis as $uni)
                <option value="{{$uni -> id}}" >{{$uni -> name}}</option>
            @endforeach
        </select>

        <br><br>
        <button type="submit">ثبت نهایی درخواست انتفالی </button>
    </form>
    
</body>
</html>