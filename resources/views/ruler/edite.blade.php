<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=\, initial-scale=1.0">
    <title>edite_ruler</title>
    @include('menu')
</head>
<body>
    <br><br><br>
    <h1>this is a edite ruler</h1>

    <form action="{{url('/ruler/update')}}" method="POST">
        @csrf
        <input type="hidden" name ="id" value="{{$ruler -> id}}"><br><br>
        <input type="text" name ="name" value="{{$ruler -> name}}"><br><br>
        <select name="uni_id">
            <option >دانشکاه را انتخاب کن</option>
            @foreach($unis as $uni)
                <option value="{{$uni -> id}}" 
                
                    <?php 
                        if($uni -> id == $ruler['uni'] -> id){echo "selected";}
                    ?>
                
                >{{$uni -> name}}</option>
            @endforeach
        </select>
        <button type ="submit">submit</button>
    </form>
</body>
</html>




