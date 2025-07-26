<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=\, initial-scale=1.0">
    <title>create_lesson</title>
    @include('menu')
</head>
<body>
    <br><hr><br>
    <p style="background-color:#0505;width:313px;height:40px;">ایجاد چارت های درسی برای  ترم های تحصیلی</p>
    <?php
        
    ?>
    <form action="{{url('/lesson/store')}}"  method="POST" >
        @csrf
        نام درس : <input type="text" placeHolder="enter_name" name="name" >
        <br>
        تعداد واحد ها : <input type="text" placeHolder="enter_unit" name="unit" >
        <br><br>
        ارائه شده برای ترم : <select name="term">
            <option >برای ترم چند ارائه میشه</option>
            <option value="0"> عمومی</option>
            <?php
                for($i =1; $i<=8;$i++){

                
            ?>

                    <option value="<?=$i;?>">ترم <?=$i;?></option>

            <?php
                }
            ?>
        </select>
        <br>
        <br>
        رشته تحصیلی : <select name="field_id">
            
            @foreach($fields as $field)
                <option value="{{$field ->id}}">{{$field ->name }}&nbsp &nbsp_{{$field['college']}} &nbsp_{{$field['university']}}</option>
            @endforeach
        </select>
        <br><br>
        
        <button type="submit" class="border">submit</button>
    </form>
</body>
</html>




