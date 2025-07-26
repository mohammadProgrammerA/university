<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=\, initial-scale=1.0">
    <title>create_fieldStudy</title>
    @include('menu')
</head>
<body>
    <?php
        //  dd($colleges ->toArray());
    ?>
    <form action="{{url('/fieldStudy/store')}}"  method="POST" >
        @csrf
        <input type="text" placeHolder="enter_name" name="name" class="border">
        <select name="college_id">
            @foreach($colleges as $college)
            {{$college ->id}}
            {{$college['university']}}
                <option value="{{$college ->id}}">{{$college ->name }}_{{$college['university']}}</option>
            @endforeach
        </select>
        <br><br>
        <button type="submit" class="border">submit</button>
    </form>
</body>
</html>




