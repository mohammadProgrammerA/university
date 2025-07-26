<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=\, initial-scale=1.0">
    <title>edite_fieldStudy</title>
    @include('menu')
</head>
<body>
    <br><br><br>
    <h1>this is a edite fieldStudy</h1>

    <form action="{{url('/fieldStudy/update')}}" method="POST">
        @csrf
        <input type="hidden" value="{{$fieldStudy -> id}}" name="id">
        <input type="text" placeHolder="enter_name" name="name" class="border" value="{{$fieldStudy -> name}}">
        <br><br>
         <select name="college_id">
            
            @foreach($colleges as $colleg)
                <option value="{{$colleg -> id}}" <?php if($colleg ->id === $college_id){echo "selected";}?>>{{$colleg -> name}}{{$colleg-> university}}</option>
            @endforeach
        </select>
        <button type="submit" class="border">submit</button>
    </form>
</body>
</html>




