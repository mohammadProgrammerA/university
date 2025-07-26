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
    <form action="{{url('/master/updata')}}" method="POST">
        @csrf
        master <input type="text" name="name" value="{{$master_edite['master_info'] -> name}}">
        <input type="hidden" name="id" value="{{$master_edite['master_info'] ->id}}">

   <a style="background-color:yellow;width:200px;" href="{{url('/master/edite/'.$master_edite['master_info'] -> id . '_all')}}">ادیت همراه با انتخاب دانشکاه های دیگر</a>
    @foreach($allData as $uni_id => $uni)
        
        <h3 style="background-color:red;width:160px;margin-left:10px;">{{$uni["uni_data"] -> name}}<input type="checkbox" name="unis[{{$uni_id}}]" <?php
        if(isset($master_edite['uni'])){
             foreach($master_edite['uni'] as $uniId => $uniEdit){
                if($uniId == $uni_id){
                    echo "checked";
                    $university[]=$uniEdit;
                }
            }
        }
            
            ?>>
        </h3>
        
        @if(isset($uni["colleges"]))

            @foreach($uni["colleges"] as $college_id => $college)
                
                   
                <h4 style="background-color:gray;width:100px;margin-left:50px;">{{$college["college_data"]}} {{$college_id}}<input type="checkbox" name="unis[{{$uni_id}}][{{$college_id}}]"
                   <?php
                      if(isset($university) && is_array($university)){
                        foreach($university as $key=> $collegeMaster){
                            foreach($collegeMaster['college'] as $collegeId => $coollege_master){
                                
                                if($collegeId ==$college_id){
                                    echo "checked";
                                    $colleges[]=$coollege_master;
                                }
                              
                            }
                        }
                      }
                    ?> 
                ></h4>

                <?php
                   
                ?>         
                @if(isset($college["fields"] ))

                    @foreach($college["fields"] as $field_id => $field)
                            <?php
                        
                            ?>
                        <h5 style="background-color:skyblue;width:100px;margin-left:100px;">{{$field["field_data"] }}{{$field_id}} <input type="checkbox" name="unis[{{$uni_id}}][{{$college_id}}][{{$field_id}}]"
                            <?php
                            if(isset($colleges) && is_array($colleges)){

                                foreach($colleges as $key=> $fieldMaster){
                                        foreach($fieldMaster['fields'] as $fieldId => $field_master){

                                            if($fieldId == $field_id ){
                                                echo "checked";
                                                $fields[]=$field_master;
                                            }
                                        }
                                }
                            } 
                                
                            ?> 

                        ></h5>

                            @if(isset($field["lessons"]))
                                        
                                @foreach($field["lessons"] as $lesson_id => $lesson)
                                        <h6 style="background-color:yellow;width:50px;margin-left:150px;">{{$lesson}}<input type="checkbox" name="unis[{{$uni_id}}][{{$college_id}}][{{$field_id}}][{{$lesson_id}}]"
                                           <?php
                                            if(isset($fields) && is_array($fields)){
                                                    foreach($fields as $key=> $lessonMaster){
                                                        foreach($lessonMaster['lessons'] as $lessonId => $lesson_master){

                                                            if($lessonId ==$lesson_id){
                                                                echo "checked";
                                                                
                                                            }
                                                        }
                                                    }
                                            }
                                            ?> 

                                        ><h6>
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




