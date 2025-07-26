<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\university;
use App\Models\university_college;
use App\Models\college;
use App\Models\college_fieldStudy;
use App\Models\fieldStudy;
use App\Models\student;
use App\Models\midde_student;
use App\Models\term;
use App\Models\lesson_field;
use App\Models\lesson;
use App\Models\master_vaset;
use App\Models\master;
use App\Models\unis;
use App\Models\transfer;
use App\Models\status;
use App\Models\score;







class StudentController extends Controller
{
    public function create(){
        $unis = university::all();
        return view("student.create",["unis"=> $unis]);
    }
    public function subCreate(Request $request){
        $student =["name" => $request -> name  , "student_code" => $request -> student_code,"year" => $request -> year];
        $university_colleges = university_college::where("university_id",$request -> uni_id) ->get();
        $uni = university::find($request -> uni_id);
        $allData [$request -> uni_id]["uni_data"] = $uni;
        foreach($university_colleges as $university_college){
            $college = college::find($university_college -> college_id);
            $allData [$request -> uni_id]["colleges"][$college ->id]["college_data"]= $college;

            $college_fieldStudys = college_fieldStudy::where("college_id",$college -> id) -> get();
            foreach($college_fieldStudys as $college_fieldStudy){
                $fieldStudy =fieldStudy::find($college_fieldStudy -> fieldStudy_id);
                $allData [$request -> uni_id]["colleges"][$college ->id]["fields"][$fieldStudy -> id]= $fieldStudy;

            }
        }
    
        return view("student.subCreate",["allData" => $allData , "student" => $student ]);
    }


    public function store(Request $request){
        
        $student_id = student::insertGetId([
            "name" => $request -> name , 
            "student_code" => $request -> student_code,
            "year" => $request -> year
        ]);
        $row_midde_student = midde_student::insertGetId([
            "student_id" => $student_id,
            "college_id" => $request -> college,
            "uni_id" => $request -> uni_id,
            "field_id" => $request -> field
        ]);

        term::create([
            "student_id" =>  $student_id,
            "number_term" => 1
        ]);

        status::create([
            "middle_student_id" => $row_midde_student,  
            "number_term" => 1,  
            "status" => 1,
            "transfer_details" => "تا به حال درخواست انتقالی نداده " ,  
        ]);

        return redirect("student/show/".$student_id);
      
    }

    public function show($id){
        $student = student::find($id);
        $midde_students = midde_student::where("student_id",$id) ->get();

        $student_datas=[];
        $student_datas["student_data"] = $student;
        
        foreach($midde_students as $midde_student){
                $status = status::where("middle_student_id",$midde_student -> id) -> get();
                $student_datas["uni"][$midde_student -> uni_id]["uniData"] =university::find( $midde_student -> uni_id);
                $student_datas ["uni"][$midde_student -> uni_id]["colleges"] [$midde_student -> college_id]["college_data"] =college::find( $midde_student -> college_id);
                $student_datas["uni"][$midde_student -> uni_id]["colleges"] [$midde_student -> college_id]["field"][$midde_student -> field_id]["field_data"]=fieldStudy::find( $midde_student -> field_id);       


                if($status[0] -> status =="0"){
                        $student_datas["uni"][$midde_student -> uni_id]["status"] = "  فعال نیست در" .( university::find( $midde_student -> uni_id)) -> name;
                }else{
                        $student_datas["uni"][$midde_student -> uni_id]["status"] = "  فعال است در" .( university::find( $midde_student -> uni_id)) -> name;

                    }
        }
        return view("student.single" , ["student" => $student,"student_datas" => $student_datas]);
    }


    public function index(){
        $students = student::all();
        $allData=[];
        foreach($students as $student){
            $midde_students=midde_student::where("student_id" , $student -> id) -> get();
            $allData [$student ->id]["student_data"] = $student;
            foreach($midde_students as $midde_student){
                $status = status::where("middle_student_id",$midde_student -> id) -> get();
                
                $allData [$student ->id] ["uni"][$midde_student -> uni_id]["uniData"] =university::find( $midde_student -> uni_id);
                $allData [$student ->id] ["uni"][$midde_student -> uni_id]["colleges"] [$midde_student -> college_id]["college_data"] =college::find( $midde_student -> college_id);
                $allData [$student ->id] ["uni"][$midde_student -> uni_id]["colleges"] [$midde_student -> college_id]["field"][$midde_student -> field_id]["field_data"]=fieldStudy::find( $midde_student -> field_id);

                
                    if($status[0] -> status =="0"){
                        $allData [$student ->id] ["uni"][$midde_student -> uni_id]["status"] = "  فعال نیست در" .( university::find( $midde_student -> uni_id)) -> name;
                    }else{
                        $allData [$student ->id] ["uni"][$midde_student -> uni_id]["status"] = "  فعال است در" .( university::find( $midde_student -> uni_id)) -> name;

                    }
            }
        }
        
        return view("student.index",["allData" => $allData]);
    }






     public function edit($id){
        $student= student::find($id);
        $unis = university::all();
        $row_midde_students = midde_student::where("student_id",$id) ->get();

        foreach($row_midde_students as $row_midde_student){
            $status= status::where("middle_student_id" , $row_midde_student->id) -> get();

            if($status[0]->status ==1){
                $midde_student = $row_midde_student;
            }
        }



        $uni = university:: find($midde_student  ->uni_id );
        $college = college::find($midde_student  ->college_id );
        $field = fieldStudy::find($midde_student  ->field_id );


        $student["student_data"] = $student;
        $student["uni"] = $uni;
        $student["college"] = $college;
        $student["field"] = $field;
       
        return view("student.edit" , ["student" => $student ,"unis" =>$unis]);
    }


    public function subEdit(Request $request){

        $student =["name" => $request -> name  , "student_code" => $request -> student_code,"year" => $request -> year,"id" => $request -> id];

 
        $midde_student = midde_student::where("student_id",$request -> id) ->get();
        $uni = university:: find($midde_student[0]  ->uni_id );
        $college = college::find($midde_student [0] ->college_id );
        $field = fieldStudy::find($midde_student [0] ->field_id );

        $student_edit["student_data"] = $student;
        $student_edit["uni"] = $uni;
        $student_edit["college"] = $college;
        $student_edit["field"] = $field;


        $university_colleges = university_college::where("university_id",$request -> uni_id) ->get();
        $uni = university::find($request -> uni_id);

        $allData [$request -> uni_id]["uni_data"] = $uni;

        foreach($university_colleges as $university_college){
            $college = college::find($university_college -> college_id);
            $allData [$request -> uni_id]["colleges"][$college ->id]["college_data"]= $college;

            $college_fieldStudys = college_fieldStudy::where("college_id",$college -> id) -> get();
            foreach($college_fieldStudys as $college_fieldStudy){
                $fieldStudy =fieldStudy::find($college_fieldStudy -> fieldStudy_id);
                $allData [$request -> uni_id]["colleges"][$college ->id]["fields"][$fieldStudy -> id]= $fieldStudy;

            }
        }
        return view("student.subEdit" ,["allData" => $allData , "student" => $student ,"student_edit" => $student_edit] );
    }



    public function delete($id){
        $student= student::find($id);
        $midde_students = midde_student::where("student_id" , $id) -> get();
        foreach($midde_students as $midde_student){

            $row_midde_student = midde_student::find($midde_student -> id);
            $status_row =status::where("middle_student_id" , $midde_student -> id) -> get();
            $status = status::find( $status_row[0] -> id);
            $row_midde_student -> delete();
            $status -> delete();
        }
        $transfer_row=transfer::where("student_id",$id) -> get();
        $transfer=transfer::find($transfer_row[0]->id);
        $transfer -> delete();
        $student -> delete();

        return redirect("student/index");
    }

    public function profile(){
        return view("student.log");
    }

    public function log(Request $request){
        $student_row = student::where("student_code" , $request -> student_code) -> get();
        
        if(!isset($student_row[0])){
            return view("student.log");
        }
        $student = student::find($student_row[0] -> id);
       
        $midde_students = midde_student::where("student_id",$student -> id) ->get();
        

          foreach($midde_students as $midde_student){

            $status= status::where("middle_student_id" , $midde_student->id) -> get();

            if($status[0]->status ==1){
               $uni = university    :: find($midde_student  ->uni_id );
                $college = college::find($midde_student ->college_id );
                $field = fieldStudy::find($midde_student ->field_id );

                $student["student_data"] = $student;
                $student["uni"] = $uni;
                $student["college"] = $college;
                $student["field"] = $field;
            }
        }  

        $student_terms = term::where("student_id" ,$student -> id) -> get();
        $row_term = $student_terms -> toArray();
        $number_term= array_pop($row_term) ;
        $length_term = $number_term ['number_term'];

        $student["term"] = $length_term; 
        
        return view("student.profile" , ["student" => $student]);
    }

    public function update(Request $request){
        $student= student::find($request -> id);
        $student -> name = $request -> name ;
        $student -> student_code = $request -> student_code;
        $student -> year = $request -> year;


        $midde_student = midde_student::where("student_id" , $request -> id) -> get();
        
        $student_uni_college_field = midde_student::find($midde_student[0] -> id);
        $student_uni_college_field  -> student_id = $request -> id;
        $student_uni_college_field  -> uni_id = $request -> uni_id;
        $student_uni_college_field  -> college_id = $request -> college;
        $student_uni_college_field  -> field_id = $request -> field;

        $student -> save();
        $student_uni_college_field -> save();

        return redirect("student/show/".$request -> id);
    }

    public function indexTerm($id){

        $student = student::find($id);

        $student_terms = term::where("student_id" , $id) -> get();
        $totalAverage = 0;
        foreach($student_terms as $student_term){
            $score_total = 0;
            $number_unit =0;
            $notPassed =0;
            $passed =0;
            $middle_student = midde_student::where("student_id" , $id) ->get();
            // dd($middle_student);
            $units = unis::where("number_term" , $student_term -> number_term) -> where("student_id",$student -> id)-> get();
            foreach($units as $unit){
                $row_scores = score::where("middle_units" , $unit -> id) -> get();
               
                foreach($row_scores as $row_score){
                    $score = score::find($row_score -> id);
                    $unitData = unis :: find($score ->middle_units);

                    $lesson = lesson::find($unitData -> lesson_id);
                    $master = master::find($unitData -> master_id);
                    $number_unit += $lesson -> unit;
                    $score_total +=$score ->score * $lesson -> unit;
                    $unit_data ["score_data"][$student_term -> number_term][$score ->middle_units][$lesson -> name][$master -> name]= $score ->score;
                    if($score ->score < 10 ){
                        $notPassed +=$lesson -> unit;
                    }
                    if($score ->score > 10 ){
                        $passed +=$lesson -> unit;
                    }
                }
                
            }
            $scores=[];
            if($number_unit != 0){
                $average = $score_total/$number_unit;
                $unit_data ["terms_data"][$student_term -> number_term]["average"] = $average;
                $totalAverage = $average;
            }else{
                $unit_data ["terms_data"][$student_term -> number_term]["average"] = 0;
            }
            $unit_data["terms_data"] [$student_term -> number_term]["total_unit"] = $number_unit;
            $unit_data ["terms_data"][$student_term -> number_term]["notPassed"] = $notPassed;
            $unit_data ["terms_data"][$student_term -> number_term]["passed"] = $passed;
            
        }

        $unit_data ["totalAverage"] = $totalAverage;

        return view("student.studentTerms",["unit_data" => $unit_data,"student" => $student]);
    
    }

    public function showLessons($id){

        $student= student::find($id);
        
        
        $midde_students = midde_student::where("student_id" , $id) -> get();

         foreach($midde_students as $midde_student){

            $status= status::where("middle_student_id" , $midde_student->id) -> get();

            if($status[0]->status ==1){

                $lessons_field = lesson_field::where("field_id" ,$midde_student -> field_id ) -> get();
            }
        }
        
        
        $student_terms = term::where("student_id" , $id) -> get();
        $row_term = $student_terms -> toArray();
        $number_term= array_pop($row_term) ;
        $lessons=[];
        foreach($lessons_field  as $lesson_field){
            $lesson = lesson::find($lesson_field -> lesson_id);
            if($number_term ['number_term'] == $lesson -> term){
                $lessons[]=$lesson;
            }

        }
        $student["number_term"] = $number_term ['number_term'];
        return view("student.showLessons",["student" => $student,"lessons" => $lessons]);
    }


    public function selectUnit($id){

        $student= student::find($id);
        
        $midde_students = midde_student::where("student_id" , $id) -> get();

         foreach($midde_students as $midde_student){

            $status= status::where("middle_student_id" , $midde_student->id) -> get();

            if($status[0]->status ==1){

                $lessons_field = lesson_field::where("field_id" ,$midde_student -> field_id ) -> get();
            }
        }
        
        
        $student_terms = term::where("student_id" , $id) -> get();
        $row_term = $student_terms -> toArray();
        $number_term= array_pop($row_term) ;

        $lessons=[];

        foreach($lessons_field  as $lesson_field){
            $lesson = lesson::find($lesson_field -> lesson_id);
            if($number_term ['number_term'] == $lesson -> term || $lesson -> term ==0){
                
                $lessons[]=$lesson;
            }
        }

        if(count($lessons) !=0){
            foreach($lessons as $lesson){
                $lesson_teachers[$lesson -> id]['lesson'] = $lesson;
                $master_vasets = master_vaset::where("lesson_id",$lesson->id) -> get();
                foreach($master_vasets as $master_vaset){
                        $master = master::find($master_vaset -> master_id);
                        $lesson_teachers[$lesson -> id]['mastters'][$master -> id] = $master;
                }
           }
        }else{
           $lesson_teachers =[];
        }
        

        $units = unis::where("number_term",$number_term ['number_term'] )->where("student_id",$id) -> get();

        if(count($units) != 0 ){
            
            $lesson_teachers ="dontSetUnit";
            return view("student.setUnit",["student" => $student,"lesson_teachers" => $lesson_teachers]);
        }
        return view("student.setUnit",["student" => $student,"lesson_teachers" => $lesson_teachers]);
    }


    public function storeUnits(Request $request){
        
        $student_terms = term::where("student_id" , $request -> student_id) -> get();
        $row_term = $student_terms -> toArray();
        $number_term= array_pop($row_term) ;
        $total_unis =0;
        $units = $request -> unis;
       
        foreach($units["lesson"] as $lesson_id => $checkLesson){
            $lesson = lesson::find($lesson_id );
            $total_unis += $lesson -> unit;
        }
        if($number_term ['number_term'] == 1){
            if($total_unis <=20){
                
               foreach($units["master"] as $lesson_id => $master){

                    foreach($master as $master_id => $selected){
                        unis::create([
                            "lesson_id" => $lesson_id,
                            "master_id" => $master_id,
                            "student_id" => $request -> student_id,
                            "unit" => $lesson -> unit,
                            "number_term" => $number_term ['number_term'],
                        ]);
                    }
                } 
            }
            return redirect('/student/show/' . $request -> student_id);
        }


        $averageTerm = $this -> getAverage($request -> student_id);
        

        if($averageTerm < 17 && $averageTerm > 12 ){
            if($total_unis <=20){
                
               foreach($units["master"] as $lesson_id => $master){

                    foreach($master as $master_id => $selected){
                        unis::create([
                            "lesson_id" => $lesson_id,
                            "master_id" => $master_id,
                            "student_id" => $request -> student_id,
                            "unit" => $lesson -> unit,
                            "number_term" => $number_term ['number_term'],
                        ]);
                    }
                } 
            }
        }
        if($averageTerm > 17 ){
            
            if($total_unis <=24){
                
               foreach($units["master"] as $lesson_id => $master){

                    foreach($master as $master_id => $selected){
                        unis::create([
                            "lesson_id" => $lesson_id,
                            "master_id" => $master_id,
                            "student_id" => $request -> student_id,
                            "unit" => $lesson -> unit,
                            "number_term" => $number_term ['number_term'],
                        ]);
                    }
                } 
            }
        }

        if($averageTerm >12){
            
            if($total_unis <=14){
                
               foreach($units["master"] as $lesson_id => $master){

                    foreach($master as $master_id => $selected){
                        unis::create([
                            "lesson_id" => $lesson_id,
                            "master_id" => $master_id,
                            "student_id" => $request -> student_id,
                            "unit" => $lesson -> unit,
                            "number_term" => $number_term ['number_term'],
                        ]);
                    }
                } 
            }
        }
        return redirect('/student/show/' . $request -> student_id);
    }

    public function getAverage($id){
        
        $student = student::find($id);
        $student_terms = term::where("student_id" ,$id) -> get();
        $row_term = $student_terms -> toArray();
        $number_term= array_pop($row_term) ;

        $length_term = $number_term ['number_term'];

            $score_total = 0;
            $number_unit =0;
            $units = unis::where("number_term" , $length_term -1 ) -> where("student_id",$id)-> get();

            foreach($units as $unit){
                $row_scores = score::where("middle_units" , $unit -> id) -> get();

                foreach($row_scores as $row_score){
                    $score = score::find($row_score -> id);
                    $unitData = unis :: find($score ->middle_units);

                    $lesson = lesson::find($unitData -> lesson_id);
                    $number_unit += $lesson -> unit;
                    $score_total +=$score ->score * $lesson -> unit;
                    
                }
            
            if($number_unit != 0){
                $average = $score_total/$number_unit;
            }else{
                $average = 0;
            }
           
        }
        return $average;
    }
    

    public function studentUnits($id){
        $student= student::find($id);
        $units=unis::where("student_id",$id) -> get();
        $allUnits=[];
        foreach($units as $unit){
            $allUnits [$unit -> number_term]['lessons'][$unit -> lesson_id] ["lesson_data"]= lesson::find($unit -> lesson_id);
            $allUnits [$unit -> number_term]['lessons'][$unit -> lesson_id] ["master"]=master::find($unit -> master_id);
        }
        // dd($allUnits) ;  
        return view("student.studentUnits",["student" => $student , "allUnits"=>$allUnits]);
    }



    public function editeUnit($id,$term_number){
        
        $student= student::find($id);
        $student["term"] = $term_number;
        $midde_students = midde_student::where("student_id" , $id) -> get();

        foreach($midde_students as $midde_student){

            $status= status::where("middle_student_id" , $midde_student->id) -> get();

            if($status[0]->status ==1){

                $lessons_field = lesson_field::where("field_id" ,$midde_student -> field_id ) -> get();
            }
        }
        
        $lessons=[];

        foreach($lessons_field  as $lesson_field){
            $lesson = lesson::find($lesson_field -> lesson_id);
            if($term_number == $lesson -> term || $lesson -> term ==0 ){
                $lessons[]=$lesson;
            }
        }


        foreach($lessons as $lesson){
           $lesson_teachers[$lesson -> id]['lesson'] = $lesson;
           $master_vasets = master_vaset::where("lesson_id",$lesson->id) -> get();
           foreach($master_vasets as $master_vaset){
                $master = master::find($master_vaset -> master_id);
                $lesson_teachers[$lesson -> id]['mastters'][$master -> id] = $master;
           }
        }

        $units=unis::where("student_id",$id) -> get();
        $editeUnits=[];
        foreach($units as $unit){
            $editeUnits [$unit -> lesson_id] = (master::find($unit -> master_id)) -> id;
        }

        return view("student.editeUnit",["student" => $student,"lesson_teachers" => $lesson_teachers,"editeUnits" => $editeUnits]);

    }



    public function updateUnite(Request $request){
       
        $units = unis::where("student_id",$request -> student_id) -> where("number_term" , $request -> term_number)-> get();
        foreach($units  as $unit){
            $unit -> delete();
        }

        $total_unis =0;
        $units = $request -> unis;
       

        foreach($units["lesson"] as $lesson_id => $checkLesson){
            $lesson = lesson::find($lesson_id );
            $total_unis += $lesson -> unit;
        }
        if($request -> term_number == 1){
            if($total_unis <=20){
               foreach($units["master"] as $lesson_id => $master){

                    foreach($master as $master_id => $selected){
                        unis::create([
                            "lesson_id" => $lesson_id,
                            "master_id" => $master_id,
                            "student_id" => $request -> student_id,
                            "unit" => $lesson -> unit,
                            "number_term" =>$request -> term_number,
                        ]);
                    }
                } 
            }
        }
        return redirect('/student/studentUnits/'.$request -> student_id);
       
    }


    public function requests($id){
        $student= student::find($id);
        return view("student.request",["student" => $student]);
    }

    public function result_requests($id){
        $student= student::find($id);
        $transfers = transfer::where("student_id",$id) -> get();
        
        if(count($transfers) ==0){
            
            $transfer=" شما  در این ترم " ."  درخواست انتقالی نداده اید";

            return view("student.resulRequests",["student" => $student,"transfer" => $transfer]);
        }
       
        if($transfers[0]->status ==null){
            $transfer="با درخواست انقالی شما  در ترم ".$transfers[0]->number_term ." موافقت نشده است";
            
            return view("student.resulRequests",["student" => $student,"transfer" => $transfer]);
        }

        $transfer="با درخواست انقالی شما  در ترم ".$transfers[0]->number_term ." موافقت شده است";

        
        return view("student.resulRequests",["student" => $student,"transfer" => $transfer]);

    }


    public function leave($id){
        $student= student::find($id);

        $midde_students = midde_student::where("student_id" , $id) -> get();

        foreach($midde_students as $midde_student){

            $status= status::where("middle_student_id" , $midde_student->id) -> get();

            if($status[0]->status ==1){
                $status = status::find($status[0] -> id);
                $status  -> leave = 1;
                $status -> save();
            }
        }
        return redirect('/student/requests/'.$id);

    }


    public function transfer($id){
        $student= student::find($id);

        $midde_students= midde_student::where("student_id", $id) -> get();
        // dd($midde_student);
        foreach($midde_students as $midde_student){
            $status= status::where("middle_student_id" , $midde_student->id) -> get();
            if($status[0]->status ==1){
                $university = university::find($midde_student -> uni_id);

                $student["uni"] = $university;
            }
        }

        $unis = university::all();

        return view("student.transfer1",["student" => $student,"unis" => $unis]);
    }

    public function transfer2(Request $request){
        $student_id = $request -> student_id;
        $student= student::find($request -> student_id);
        $student ["nowUni"]= $request -> nowUni;
        $uni = university::find($request -> nextUni);

        $university_colleges = university_college::where("university_id",$request -> nextUni) ->get();

        $allData [$request -> nextUni]["uni_data"] = $uni;

        foreach($university_colleges as $university_college){
            $college = college::find($university_college -> college_id);
            $allData [$request -> nextUni]["colleges"][$college ->id]["college_data"]= $college;

            $college_fieldStudys = college_fieldStudy::where("college_id",$college -> id) -> get();

            foreach($college_fieldStudys as $college_fieldStudy){

                $fieldStudy = fieldStudy::find($college_fieldStudy -> fieldStudy_id);
                $allData [$request -> nextUni]["colleges"][$college ->id]["fields"][$fieldStudy -> id]= $fieldStudy;

            }
        }
  
        return view("student.transfer2",["allData" => $allData , "student" => $student]);
    }

    public function storeTransfer(Request $request){

        $student_terms= term::where("student_id" , $request -> student_id) -> get();
        $row_term = $student_terms -> toArray();
        $number_term = array_pop($row_term) ;

        
        transfer::create([

            "nowUni" => $request -> nowUni,
            "nextUni" => $request -> nextUni,
            "student_id" => $request -> student_id,
            "college" => $request -> college,
            "field" => $request -> field,
            "status" => $request -> status,
            "number_term" => $number_term ['number_term']

        ]);
        return redirect('/student/requests/'.$request -> student_id);
    }

    public function logEnteringGrades(){
        return view("student.logEnteringGrades");
    }

    public function enteringGrades(Request $request){
        $student_row = student::where("student_code" , $request -> student_code) -> get();
        
        if(!isset($student_row[0])){
            return view("student.enteringGrades");
        }
        $student = student::find($student_row[0] -> id);
       
        $midde_students = midde_student::where("student_id",$student -> id) ->get();

          foreach($midde_students as $midde_student){

            $status= status::where("middle_student_id" , $midde_student->id) -> get();

            if($status[0]->status ==1){
               $uni = university :: find($midde_student  ->uni_id );
                $college = college::find($midde_student ->college_id );
                $field = fieldStudy::find($midde_student ->field_id );

                $student["student_data"] = $student;
                $student["uni"] = $uni;
                $student["college"] = $college;
                $student["field"] = $field;
            }
        }  

        $student_terms = term::where("student_id" ,$student -> id) -> get();
        $row_term = $student_terms -> toArray();
        $number_term= array_pop($row_term) ;
        $length_term = $number_term ['number_term'];

        $student["term"] = $length_term; 


        $units = unis::where("student_id" , $student -> id) -> where("number_term",  $length_term) -> get();
        $allUnits=[];
        foreach($units as $unit){
            $allUnits [$unit -> id] ["unitData"]=$unit;
            $allUnits [$unit -> id]["master"] = master::find($unit -> master_id);
            $allUnits [$unit -> id]["lesson"] = lesson::find($unit -> lesson_id);
        }
        return view("student.scores" , ["student" => $student,"allUnits" => $allUnits]);
    }


    public function enteringGradesStore(Request $request){

       foreach($request -> units as $unit_id => $score){
            $scores = score::all();
            foreach($scores  as $score_row){
                if($unit_id == $score_row ->middle_units  ){
                    return redircte("student.logEnteringGrades");
                }
            }
       }
        


        foreach($request -> units as $unit_id => $score){
            score::create([
                    "middle_units" => $unit_id ,
                    "score" => $score
            ]);

        }

        // dd($request -> student_id);
        $student_terms = term::where("student_id" ,$request -> student_id) -> get();
        $row_term = $student_terms -> toArray();
        $number_term= array_pop($row_term) ;
        $length_term = $number_term ['number_term'];

        // dd();

        term::create([
            "student_id" =>  $request -> student_id,
            "number_term" => $length_term  +=1
        ]);

    }

    public function updateScore(Request $request){
        dd($request -> score);
    }

}  

