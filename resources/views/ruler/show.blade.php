<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>single _ ruler</title>
</head>
<body>
    
    <div> ruler:  {{$ruler -> name}}</div>
    <div> universtiy:  {{$ruler['uni'] -> name}}</div>
    <br><br>
    
    <a style="background: #22C1C3;
background: linear-gradient(0deg, rgba(34, 193, 195, 1) 0%, rgba(253, 187, 45, 1) 100%);width:200px;" href="{{url('/ruler/transfers/' . $ruler -> id)}}">لیست درخواست های انتقالی</a>
    

    <br><br>
    
    <a style="background-color:#8FBC8F;width:200px; color:red;" href="{{url('/ruler/edite/' . $ruler -> id)}}">edite_ruler</a>
    <br><br>
    <a style="background-color:#0101;width:200px; color:red;" href="{{url('/ruler/delete/'.$ruler -> id)}}">delete_ruler</a>

    <br><br>
   
</body>
</html>