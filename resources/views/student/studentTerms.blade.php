<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>info Term {{$student -> name}}</title>
    @include("menu")
</head>
<body>
    <h2>  ریز کارنامه برای هر ترم  {{$student -> name}}</h2>
    




       <form action="{{url('student/updateScore')}}" method="POST">
            @csrf
            <div style ="width:250px ; background-color:#98FB98;margin-top :10px;"><sapn> معدل کل ___{{$unit_data["totalAverage"]}} تمام ترم ها</span></div>
            <br><br>
            @if(isset($unit_data["score_data"]))
            @foreach($unit_data["score_data"] as $term_number => $scores)
                <div style ="width:200px ; background-color:#0102;">{{$term_number}} ریز کارنامه ترم </div>
                @foreach($scores as $middle_unit_id => $lesson)
                    {{$middle_unit_id}}

                    @foreach($lesson as $lesson_name => $master)

                        <div style ="width:200px ; background-color:#0102;margin-left:100px;">lesson : {{$lesson_name}} </div>

                        @foreach($master as $master_name => $score)
                            <div style ="width:200px ; background-color:#0503;margin-left:150px;margin-top :10px;">master_name:  {{$master_name}} </div>
                            <input value = "{{$score}} "  name="score[{{$middle_unit_id}}]" style ="width:80px ; background-color:aqua;margin-left:200px;margin-top :10px;">نمره :   
                            <input type="hidden" value ="{{$middle_unit_id}}">
                        @endforeach

                    @endforeach
                <br>
                @endforeach
            
            <button>ویرایش نمرات وارد شده </button>
            
            <br><hr style ="background-color:#8B4513;height:3px;"><br>
        </form>
            @endforeach
            @else
            <h1>هنوز نمرات ترم قبل وارد نشده است</h1>
            @endif







    @foreach($unit_data["terms_data"] as $term_number => $term_data)
        <?php 
            // dd($term_data['average']);
        ?>
        <div style ="width:200px ; background-color:#BDB76B;" > {{$term_number}}   سوابق و جزئیات ترم </div>
        <div style ="width:200px ; background-color:#0102;margin-left:100px;">معدل این ترم : {{$term_data['average']}} </div>
        <div style ="width:250px ; background-color:#0503;margin-left:150px;margin-top :10px;">تمام واحد های برداشت شده این ترم :   {{$term_data['total_unit']}} </div>
         <div style ="width:150px ; background-color:#00FF00;margin-left:200px;margin-top :10px;">واحد های پاس شده  :   {{$term_data['passed']}}</div>
         <div style ="width:150px ; background-color:#9370DB;margin-left:200px;margin-top :10px;">واحد های  افتاده  :   {{$term_data['notPassed']}}</div>
        <br><hr style ="background-color:#800000;height:4px;">
    @endforeach
    
</body>
</html>