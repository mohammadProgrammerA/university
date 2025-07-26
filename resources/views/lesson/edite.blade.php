<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=\, initial-scale=1.0">
    <title>edite_lesson</title>
    @include('menu')
</head>
<body>
    <br><br><br>
    <h1>this is a edite lesson</h1>

    <form action="{{url('/lesson/update')}}" method="POST">
       @csrf
        <input type="hidden" name = "id" value ="{{$lesson -> id}}">
        <input type="text" placeHolder="enter_name" name="name" value ="{{$lesson -> name}}">
        <br>
        <input type="text" placeHolder="enter_unit" name="unit" value ="{{$lesson -> unit}}">
        <br><br>
          ارائه شده برای ترم : <select name="term">
              <option >برای ترم چند ارائه میشه</option>
              <option value ="0" <?php if($lesson -> term == 0){ echo "selected";}?>>عمومی</option>
            <?php
                for($i =1; $i<=8;$i++){

                
            ?>

                    <option value="<?=$i;?>"
                        <?php
                            if($i == $lesson -> term){
                                echo "selected";
                            }
                        ?>
                    >ترم <?=$i;?></option>

            <?php
                }
            ?>
           
        </select>
        <br><br>
        ارائه شده برای رشته <select name="field_id">
            @foreach($fields as $field)
                <option value="{{$field ->id}}" <?php if($fieldId == $field -> id){echo "selected";}?>>
                    {{$field ->name }}&nbsp &nbsp &nbsp{{$field['university']}}
                </option>
            @endforeach
        </select>
        <br><br>
        <button type="submit" class="border">submit</button>
    </form>
</body>
</html>




