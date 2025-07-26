<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>index ruler</title>
    @include("menu")
</head>
<body>
      <h1>لیست رئیس دانشگاه ها</h1>
    <br><hr><br>
    @foreach($rulers as  $ruler)
             <p style="background-color:#0103;width:200px;">name &nbsp {{$ruler -> name}}</p>
             <p style="background-color:#0103;width:200px;">دانشگاه  &nbsp &nbsp {{$ruler['uni'] -> name}}</p>
             <a style="background-color:green;width:200px; color:white;" href="{{url('/ruler/edite/'.$ruler -> id)}}">edite_ruler</a>
             <a style="background-color:#0101;width:200px; color:red;" href="{{url('/ruler/delete/'.$ruler -> id)}}">delete_ruler</a>
             <a style="background-color:red;width:200px; color:white;" href="{{url('/ruler/show/'.$ruler -> id)}}">show_ruler</a>
            <br><hr><br>
        @endforeach
</body>
</html>