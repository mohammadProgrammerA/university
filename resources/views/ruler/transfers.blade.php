<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>درخواست ها از {{$ruler -> name}}</title>
    @include('menu')
</head>
<body>

    <h1 style="background-color:#BDB76B;width:800px;"> دارد{{$ruler -> name}} درخواست های انتفالی که نیاز به تایید </h1>
    <h1 style="background-color:#ADFF2F;width:313px;"> rulerUniversitys : {{$ruler['uni'] -> name}}</h1><br><br>
    

    @foreach($allTransfers as $id_transfer => $transfer)
        
        <div style="background-color:#F4A460;height:320px;width:200px;margin-top:20px;pading:10px;">
                 <div style="background-color:#FFFACD;width:150px;margin-top:10px;">NAME : {{$transfer["student"] -> name}}</div>
                 <div style="background-color:#FFFACD;width:150px;margin-top:10px;margin-left:10px;">{{$transfer["student"]['uni'] -> name}}</div>
                 <div style="background-color:#FFFACD;width:150px;margin-top:10px;margin-left:30px;">{{$transfer["student"]['college'] -> name}}</div>
                 <div style="background-color:#FFFACD;width:150px;margin-top:10px;margin-left:50px;">{{$transfer["student"]['field'] -> name}}</div>
                 <div style="background-color:#9ACD32;width:150px;margin-top:10px;height:70px;margin-left:22px;">
                   NEXT_UNI :  {{$transfer["nextUni"] -> name}}
                    <br>
                    <form action="{{url('/ruler/transferStudent')}}" method="POST">
                        @csrf
                        <input type="hidden" name ="ruler_id" value="{{$ruler -> id}}">
                        <input type="hidden" name ="nextUni" value="{{$transfer['transfer']['nextUni']}}">
                        <input type="hidden" name ="nowUni" value="{{$transfer['transfer']['nowUni']}}">
                        <input type="hidden" name ="college" value="{{$transfer['transfer']['college']}}">
                        <input type="hidden" name ="field" value="{{$transfer['transfer']['field']}}">
                        <input type="hidden" name ="student_id" value="{{$transfer['student'] -> id}}">
                        <input type="hidden" name ="number_term" value="{{$transfer['transfer']['number_term']}}">
                        <button>موافقت برای انتقال {{$transfer["student"] -> name}}</button>
                    </form>
                 </div>

                <div>

                    @if($transfer["transfer"] -> status == null)
                     <br>
                     <div style="background-color:#98FB98;width:150px;margin-top:5px;margin-left:10px;">وضعیت درخواست انتفالی<h4>هنوز با درخواست تخصیلی این دانشجو موافقت نشده است</h4></div>

                    
                    @else
                        <div style="background-color:#FFFF00;width:150px;margin-top:10px;margin-left:10px;">{{$transfer["nextUni"] -> name}}انتقال یافت به </div>
                    @endif

                </div>
               
        </div>
    @endforeach


</body>
</html>