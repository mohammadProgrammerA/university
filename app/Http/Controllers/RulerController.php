<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MOdels\ruler;
use App\MOdels\university;
use App\MOdels\transfer;
use App\MOdels\student;
use App\Models\fieldStudy;
use App\Models\college;
use App\Models\midde_student;
use App\Models\status;




class RulerController extends Controller
{
     public function create(){
        $unis = university::all();
        return view("ruler.create",["unis"=> $unis]);
    }


     public function store(Request $request){
        
        ruler::create([
            "name" =>  $request -> name,
            "uni_id" => $request -> uni_id
        ]);

        return redirect("ruler/index/");
      
    }

    public function index(){
        $rulers = ruler::all();
        foreach($rulers as $ruler){
            $ruler['uni'] = university::find($ruler -> uni_id);
        }
        
        return view("ruler.index",["rulers" => $rulers]);
    }

    public function edite($id){
        $ruler = ruler::find($id);

        $ruler['uni'] = university::find($ruler -> uni_id);


        $unis = university::all();
        return view("ruler.edite",["unis" =>$unis,"ruler" => $ruler]);
    }


    public function update(Request $request){
        $ruler = ruler::find($request -> id);
      
        $ruler -> name = $request -> name ;
        $ruler -> uni_id = $request -> uni_id ;

        $ruler -> save();
        return redirect("ruler/index");

    }



    public function delete($id){
        $ruler = ruler::find($id);
        $ruler ->delete();
        return redirect("ruler/index");
    }

    public function show($id){
        $ruler = ruler::find($id);
        $ruler['uni'] = university::find($ruler -> uni_id);
        return view("ruler.show",["ruler" =>$ruler]);
    }


    public function transfers($id){

        $ruler = ruler::find($id);
        
        $ruler["uni"] = $rulerUnis = university :: find($ruler  ->uni_id );
        $transfers = transfer::where("nowUni" , $ruler -> uni_id) -> get();
        $allTransfers=[];
        foreach($transfers as $transfer){

            $student = student::find($transfer -> student_id);
            $midde_students = midde_student::where("student_id",$student -> id) ->get();
            
            foreach($midde_students as $midde_student){
            $status= status::where("middle_student_id" , $midde_student->id) -> get();

                if($status[0]->status ==1){
                    $uni = university :: find($midde_student ->uni_id );
                    $college = college::find($midde_student  ->college_id );
                    $field = fieldStudy::find($midde_student ->field_id );
                }
            }
           
            $student["uni"] = $uni;
            $student["college"] = $college;
            $student["field"] = $field;
            $allTransfers[$transfer -> id]["student"] = $student;
            $allTransfers[$transfer -> id]["transfer"] = $transfer;
            
            $allTransfers[$transfer -> id]["nextUni"] = university :: find($transfer  ->nextUni );
        }
      
        return view("ruler.transfers",["ruler" => $ruler , "allTransfers" => $allTransfers]);
    }


  

    public function transferStudent(Request $request){
        $midde_student = midde_student ::where("student_id" , $request -> student_id) -> where("uni_id" , $request -> nowUni) -> get();
        $transfer_row=transfer::where("student_id",$request -> student_id) ->where("nowUni",$request -> nowUni) ->get();
        $transfers = $transfer_row -> toArray();
        $length_transfer = array_pop($transfers);
        // dd($length_transfer["id"]);
        $transfer= transfer::find($length_transfer["id"]);
       
        // dd($transfer -> toArray());
        
        if($transfer -> status =="1"){
           
            return redirect("ruler/transfers/". $request -> ruler_id);
        }
        
        $nowUni = university::find($request -> nowUni);
        $nextUni = university::find($request -> nextUni);
        $transfer_details = "  انتقال از " . $nowUni ->name ."   به   ". $nextUni -> name;
        
        
        
        $status_row= status::where("middle_student_id" , $midde_student[0] ->id) -> get();
        
        $status = status::find($status_row[0] -> id);
        $status  -> status = 0;
        $status  -> transfer_details = $transfer_details ;

        
        $status -> save();

        

        $rowId = midde_student::insertGetId([
            "student_id" => $request -> student_id,
            "college_id" => $request -> college,
            "uni_id" => $request -> nextUni,
            "field_id" => $request -> field
        ]);

        
        status::create([
            "middle_student_id" => $rowId,  
            "number_term" => $request -> number_term,  
            "status" => 1,  
            "transfer_details" => $transfer_details ,  
        ]);

            $transfer -> status = 1;
            $transfer -> save();
        
        // dd($transfer);
        // dd($midde_student -> toArray());
        return redirect("ruler/index");

        // dd($request -> number_term);
        dd($midde_student[0] ->id);
    }


}
 