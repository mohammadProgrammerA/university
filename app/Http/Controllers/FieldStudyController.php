<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\fieldStudy;
use App\Models\college;
use App\Models\university_college;
use App\Models\university;
use App\Models\college_fieldStudy;
use App\Models\lesson_field;
use App\Models\lesson;
use App\Models\master_vaset;
use App\Models\master;

class FieldStudyController extends Controller
{
    public function create(){
        $colleges = college::all();
        foreach($colleges as $college){
            $university_college = university_college::where("college_id", $college->id) ->get();
            $uni = university::find($university_college[0] ->university_id);
            $college["university"]=$uni ->name; 
            $college["university_id"]=$uni ->id; 
        }
        return view("fieldStudy.create" , ["colleges" => $colleges]);
    }
    public function store(Request $request){
        $field_id = fieldStudy::insertGetId(
            ["name" => $request -> name]
        );
        college_fieldStudy::create(
            ["college_id" => $request -> college_id ,
              "fieldStudy_id" => $field_id
            ]
        );

        return redirect("fieldStudy/index");
    }

    public function index(){

        $fieldStudys = fieldStudy::all();
        foreach($fieldStudys as $fieldStudy){
            $college_fieldStudy = college_fieldStudy::where("fieldStudy_id", $fieldStudy->id) ->get();
            $college = college::find($college_fieldStudy[0] ->college_id);
            if($college){

                $fieldStudy["college"]=$college ->name;
            }
            $university_college = university_college::where("college_id", $college->id) ->get();
            $uni = university::find($university_college[0] ->university_id);
            $fieldStudy["university"] = $uni  ->name; 
        }
        return view("fieldStudy.index",["fieldStudys" =>$fieldStudys]);
    }
    
    public function show($id){
        $fieldStudy = fieldStudy::find($id);
        $college_fieldStudy = college_fieldStudy::where("fieldStudy_id", $id) ->get();
        $college = college::find($college_fieldStudy[0] ->college_id);
        $fieldStudy["college"]=$college ->name;
        $university_college = university_college::where("college_id", $college->id) ->get();
        $uni = university::find($university_college[0] ->university_id);
        $fieldStudy["university"] = $uni  ->name; 
        return view("fieldStudy.single",["fieldStudy" =>$fieldStudy]);
    }

    public function edite($id){
        $fieldStudy = fieldStudy::find($id);
        $college_fieldStudy = college_fieldStudy::where("fieldStudy_id", $fieldStudy->id) ->get();
        $college_id = (college::find ($college_fieldStudy[0]->college_id))->id;
        $colleges = college::all();
        foreach($colleges as $college){
            $university_college = university_college::where("college_id", $college->id) ->get();
            $uni = university::find($university_college[0] ->university_id);
            $college["university"]=$uni ->name; 
            $college["university_id"]=$uni ->id; 
        }

        return view("fieldStudy.edite",["fieldStudy" =>$fieldStudy  , "colleges" => $colleges ,"college_id"=>$college_id ]);
    }

    public function update(Request $request){
        $fieldStudy = fieldStudy::find($request -> id);
        $fieldStudy -> name = $request -> name ;
        $college_fieldStudy = college_fieldStudy::where("fieldStudy_id", $fieldStudy->id) ->get();
        
            $college = college_fieldStudy::find($college_fieldStudy[0]->id);
            $college -> college_id = $request -> college_id;
            $college -> save();
        
        $college -> save();
        return redirect("fieldStudy/index");

    }

    public function delete($id){
        $fieldStudy = fieldStudy::find($id);
        $college_fieldStudy = college_fieldStudy::where("fieldStudy_id", $fieldStudy->id) ->get();
        $college_field_row = college_fieldStudy::find($college_fieldStudy[0]->id);
        $lesson_fields = lesson_field::where("field_id" , $id) -> get();
        foreach($lesson_fields as $lesson_field){
            $lesson =lesson::find($lesson_field -> lesson_id);
            if($lesson){
                $lesson -> delete();
            }
            $lesson_field -> delete();
        }
        $college_field_row->delete();
        
        
        $masters = master_vaset::where("field_id",$id)->get();
    
        if($masters){
            foreach($masters as $master){
                $master ->delete();
            }
        }
        $fieldStudy ->delete();
        

        return redirect("fieldStudy/index");

    }
    public function fieldLessons($id){
        $field = fieldStudy::find($id);
        $lessons_field= lesson_field:: where("field_id" , $id)->get();
        $college_fieldStudy=college_fieldStudy::where("fieldStudy_id",$id)->get();
        $college = college::find($college_fieldStudy[0]->college_id);
        $university_college =university_college::where("college_id",$college -> id)->get();
        $university = university::find( $university_college[0]->university_id);
       
        foreach($lessons_field as $lesson_field){
            $lesson = lesson::find($lesson_field->lesson_id);
            $lesson_field ["lesson"]= $lesson ;
            $lesson_field ["lesson_id"]= $lesson -> id;
            $lesson_field ["college"]= $college -> name;
            $lesson_field ["university"]= $university -> name;
        }
        // dd($lessons_field ->toArray());
        return view("fieldStudy.fieldLessons",["field" => $field,"lessons_field"=>$lessons_field , "university" =>$university]);
    }

    public function mastersList($id){
        $fieldStudy = fieldStudy::find($id);
        $field_masters ["field"] = $fieldStudy;
        $masters = master_vaset::where("field_id",$id)->get();
        if($masters){
            foreach($masters as $master){
            $masterInfo = master::find($master -> master_id);
           
            $field_masters ["masters"][$master ->master_id]=$masterInfo;
            
            }
        }
      
        // dd($field_masters);
        return view("fieldStudy/masters",["field_masters" => $field_masters]);
    }
   
}
