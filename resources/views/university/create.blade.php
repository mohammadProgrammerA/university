<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=\, initial-scale=1.0">
    <title>create_university</title>
    @include('menu')
</head>
<body>
    <form action="{{url('/university/store')}}"  method="POST" >
        @csrf
        <input type="text" placeHolder="enter_name" name="name" class="border">
        <br><br>
        <input type="text" placeHolder="enter_sity" name="sity">
        <br><br>
        <button type="submit" class="border">submit</button>
    </form>
</body>
</html>




