<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=\, initial-scale=1.0">
    <title>create master</title>
    @include('menu')
</head>
<body>
     <h1>this is a create master</h1>
    <form action="{{url('/master/store')}}" method="POST">
    @csrf
    master <input type="text" name="name" placeHolder="enter_naem">
    @foreach($allData as $uni_id => $uni)
       
        <h3 style="background-color:red;width:160px;margin-left:10px;">{{$uni["uni_data"] -> name}} {{$uni_id }}<input type="checkbox" name="unis[{{$uni_id}}]"></h3>

        @if(isset($uni["colleges"]))

            @foreach($uni["colleges"] as $college_id => $college)

                <h4 style="background-color:gray;width:100px;margin-left:50px;">{{$college["college_data"]}} <input type="checkbox" name="unis[{{$uni_id}}][{{$college_id}}]"></h4>

                @if(isset($college["fields"] ))

                    @foreach($college["fields"] as $field_id => $field)

                        <h5 style="background-color:skyblue;width:100px;margin-left:100px;">{{$field["field_data"] }} <input type="checkbox" name="unis[{{$uni_id}}][{{$college_id}}][{{$field_id}}]"></h5>

                            @if(isset($field["lessons"]))
                                        
                                @foreach($field["lessons"] as $lesson_id => $lesson)
                                        <h6 style="background-color:yellow;width:50px;margin-left:150px;">{{$lesson}}<input type="checkbox" name="unis[{{$uni_id}}][{{$college_id}}][{{$field_id}}][{{$lesson_id}}]"><h6>
                                @endforeach

                            @else
                                <h6  style="background-color:yellow;width:70px;margin-left:150px;"  >هنوز درسی تعریف نشده </h6>

                            @endif
                                
                    @endforeach
                @else
                <h5 style="background-color:green;width:50px;margin-left:100px;">رشته ای ندارد هنوز</h5>

                @endif

            @endforeach

        @else
                <h4  style="background-color:gray;width:100px;margin-left:50px;">دانشکده ای برای این دانشکاه نیس </h4>
        @endif
        
        <hr>
        <br>

    @endforeach

    <br>
    <button type ="submit">submit</button>
    </form>
</body>
</html>




