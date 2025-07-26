<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=\, initial-scale=1.0">
    <title>edite_college</title>
    @include('menu')
</head>
<body>
    <br><br><br>
    <h1>this is a edite college</h1>

    <form action="{{url('/college/update')}}" method="POST">
        @csrf
        <input type="hidden" value="{{$college -> id}}" name="id">
        <input type="text" placeHolder="enter_name" name="name" class="border" value="{{$college -> name}}">
        <br><br>
         <select name="university_id">
            @foreach($universitys as $university)
            {{$university ->id}}
                <option value="{{$university ->id}}" @foreach($university_college as $uniId) @if($uniId -> university_id ==$university->id){{'selected'}}  @endif @endforeach>{{$university ->name}}</option>
            @endforeach
        </select>
        <button type="submit" class="border">submit</button>
    </form>
</body>
</html>




