<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>masters_fieldStudy</title>
</head>
<body>
    <h1>this is a masters {{$field_masters["field"] -> name}}</h1>
    <br>
    @if(isset($field_masters['$masters']))
    <h3>اساتید زیر در حال ارائه هستند</h3>
        @foreach($field_masters['masters'] as $key => $master)
            <p style="background-color:#0102;width:100px;">{{$master -> name}}</p>
        @endforeach
    @else 
        <p style="background-color:red;width:313px;">هنوز بای این رشته استادی ارائه نداده درسی</p>
    @endif
</body>
</html>