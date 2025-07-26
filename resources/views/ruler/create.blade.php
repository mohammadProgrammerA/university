<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>create ruler</title>
    @include('menu')

</head>
<body>
    <form action="{{url('ruler/store')}}" method="POST" >
        @csrf
        <input type="text" name ="name" placeHolder="enter_name"><br>
        <select name="uni_id">
            <option >دانشکاه را انتخاب کن</option>
            @foreach($unis as $uni)
                <option value="{{$uni -> id}}" >{{$uni -> name}}</option>
            @endforeach
        </select>
        <button type ="submit">submit</button>
    </form>

  
    
</body>
</html>