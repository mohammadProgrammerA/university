<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>single_fieldStudy</title>
</head>
<body>
    {{$fieldStudy -> name}}
        &nbsp&nbsp&nbsp&nbsp
    {{$fieldStudy -> college}}
        &nbsp&nbsp&nbsp&nbsp
    {{$fieldStudy -> university}}

    <a href="{{url('/fieldStudy/edite/' . $fieldStudy -> id)}}">edite</a>
    <br>
    <a href="{{url('/fieldStudy/fieldLessons/'. $fieldStudy -> id)}}">نمایش دروس ارائه شده برای </a>
        &nbsp&nbsp&nbsp&nbsp
</body>
</html>