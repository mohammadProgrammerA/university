<!DOCTYPE html>
<html lang="en">
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>masters</title>
    @include('menu')
</head>
<body>
    <h1>لیست اساتید</h1>
    <br><hr><br>
    @foreach($masters as $master_id => $master)
            <p style="background-color:#0103;width:200px;">name &nbsp &nbsp {{$master["master_info"] -> name}}</p>
             <a style="background-color:green;width:200px; color:white;" href="{{url('/master/edite/'.$master_id)}}">edite_master</a>
             <a style="background-color:#0101;width:200px; color:red;" href="{{url('/master/delete/'.$master_id)}}">delete_master</a>
             <a style="background-color:red;width:200px; color:white;" href="{{url('/master/show/'.$master_id)}}">show_master</a>
                      <br><hr><br>
        @endforeach
</body>
</html>