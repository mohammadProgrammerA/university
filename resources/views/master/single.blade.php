<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>single_master</title>
    @include("menu")
</head>
<body>
    
 
        <h1> که ارائه میدهد  {{$master_info['master_info'] -> name}}   مشخصات دورسی که </h1>

             <a style="background-color:yellow;width:200px;" href="{{url('/master/edite/'.$master_info['master_info'] -> id)}}">ادیت در دانشکاه های حال حاظر</a>
             <br><br>
             <a style="background-color:yellow;width:200px;" href="{{url('/master/edite/'.$master_info['master_info'] -> id . '_all')}}">ادیت همراه با انتخاب دانشکاه های دیگر</a>
             <br><br>
             <a style="background-color:#0101;width:200px; color:red;" href="{{url('/master/delete/'.$master_info['master_info'] -> id)}}">delete_master</a>
            @if(!isset($master_info['uni']))
             <p style="background-color:#0105;width:150px;margin-left:100px;"> این استاد هنوز تدرسی ندارد</p > 
            @else
                
                @foreach($master_info['uni'] as $uni_id => $uni)
                    
                    <p style="background-color:#0105;width:150px;margin-left:100px;"> {{$uni['uni_info'] -> name}}</p >
                    @foreach($uni['college'] as $college_id => $college)

                        <p style="background-color:skyblue;width:150px;margin-left:150px;"> {{$college['college_info'] -> name}}</p >

                        @foreach($college['fields'] as $field_id => $field )

                            <p style="background-color:yellow;width:150px;margin-left:200px;"> {{$field['field_info'] -> name}}</p>
                            
                            @foreach($field["lessons"] as $lesson_id => $lesson)

                                <p style="background-color:aqua;width:150px;margin-left:250px;"> {{$lesson-> name}}</p>

                            @endforeach

                        @endforeach
                    @endforeach

                @endforeach
            @endif
            


            
           
            <br><hr><br>




</body>
</html>