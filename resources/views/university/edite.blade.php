<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=\, initial-scale=1.0">
    <title>edite_university</title>
    @include('menu')
</head>
<body>
    <br><br><br>
    <h1>this is a edite university</h1>

    <form action="{{url('/university/update')}}" method="POST">
        @csrf
        <input type="hidden" value="{{$university -> id}}" name="id">
        <input type="text" placeHolder="enter_name" name="name" class="border" value="{{$university -> name}}">
        <br><br>
        <input type="text" placeHolder="enter_sity" name="sity" value="{{$university -> sity}}">
        <br><br>
        <button type="submit" class="border">submit</button>
    </form>
</body>
</html>




