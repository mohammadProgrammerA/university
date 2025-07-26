<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=\, initial-scale=1.0">
    <title>create_college</title>
    @include('menu')
</head>
<body>
    <form action="{{url('/college/store')}}"  method="POST" >
        @csrf
        <input type="text" placeHolder="enter_name" name="name" class="border">
        <select name="university_id">
            @foreach($universitys as $university)
            {{$university ->id}}
                <option value="{{$university ->id}}">{{$university ->name}}</option>
            @endforeach
        </select>
        <br><br>
        <button type="submit" class="border">submit</button>
    </form>
</body>
</html>




