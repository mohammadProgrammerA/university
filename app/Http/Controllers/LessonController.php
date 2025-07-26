<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\college;
use App\Models\lesson;
use App\Models\university_college;
use App\Models\university;
use App\Models\fieldStudy;
use App\Models\college_fieldStudy;
use App\Models\lesson_field;
use App\Models\master_vaset;


class LessonController extends Controller
{
    public function create(){

        $fields = fieldStudy::all();
        foreach($fields  as $field){
            $college_fieldStudy = college_fieldStudy::where("fieldStudy_id",$field ->id)->get();
            $college = college::find($college_fieldStudy[0]->college_id);

            $university_college = university_college::where("college_id" , $college ->id)->get();
            $university = university::find($university_college[0]->university_id);

            $field["college"]=$college->name ;
            $field["university"]=$university->name ;
        }
        
        return view("lesson.create",["fields" =>$fields]);
    }



    public function store(Request $request){
        $lesson_id = lesson::insertGetId(
            [
                "name" => $request ->name ,
                "unit" => $request ->unit,
                "term" => $request -> term
            ]
        );
        $lesson_field = lesson_field::create(
            [
                "field_id"=>$request ->field_id,
                "lesson_id"=>$lesson_id
            ]
        );

        return redirect("lesson/index");
    }


    public function index(){
        $lessons =lesson::all();
        foreach($lessons as $lesson){
            $lesson_field = lesson_field::where("lesson_id" , $lesson->id) ->get();
            $fieldStudy = fieldStudy::find($lesson_field[0]->field_id);
            if($fieldStudy){
                $lesson["field"] = $fieldStudy -> name ;
                $college_fieldStudy =college_fieldStudy::where("fieldStudy_id" , $fieldStudy -> id) -> get();
                $university_college = university_college::where("college_id",$college_fieldStudy[0]->college_id) -> get();
            
                 $university = university::find($university_college[0]->university_id);
                 $lesson["university"] = $university -> name;
            }else{
                $lesson["field"] = "not field";
                 $lesson["university"] = "not university";
            }

        }
        return view("lesson.index",["lessons" => $lessons]);
    }


    public function show($id){
        $lesson = lesson::find($id);
        $lesson_field = lesson_field::where("lesson_id" , $lesson->id) ->get();
        $fieldStudy = fieldStudy::find($lesson_field [0]->field_id);
        
        $college_fieldStudy =college_fieldStudy::where("fieldStudy_id" , $fieldStudy -> id) ->get();
        $university_college = university_college::where("college_id",$college_fieldStudy[0]->college_id) -> get();

        $university = university::find($university_college[0]->university_id);

        return view("lesson.single",["lesson"=>$lesson,"fieldStudy"=>$fieldStudy , "university"=>$university]);
    }


    public function edite($id){
        $lesson = lesson::find($id);
        $fields = fieldStudy::all();
        $lesson_field = lesson_field::where("lesson_id",$lesson->id)->get();
        $fieldId = $lesson_field[0] ->field_id;
        foreach($fields  as $field){
            $college_fieldStudy = college_fieldStudy::where("fieldStudy_id",$field ->id)->get();
            $college = college::find($college_fieldStudy[0]->college_id);

            $university_college = university_college::where("college_id" , $college ->id)->get();
            $university = university::find($university_college[0]->university_id);

            $field["college"]=$college->name ;
            $field["university"]=$university->name ;

            
        }
        
        
        return view("lesson.edite",["lesson" => $lesson , "fields" =>$fields,"fieldId"=>$fieldId]);

    }

    public function update(Request $request){
        
        $lesson = lesson::find($request -> id);
        $lesson -> name = $request -> name;
        $lesson -> unit = $request ->unit;

        $lesson_field = lesson_field::where("lesson_id", $lesson->id) ->get();
            $field_lesson= lesson_field::find($lesson_field[0]->id);
            $field_lesson -> field_id = $request -> field_id;
            $field_lesson -> save();
            $lesson -> save();
        
        return redirect("lesson/index");
    }

    public function delete($id){
        $lesson = lesson::find($id);

        $lesson_field = lesson_field::where("lesson_id", $lesson->id) ->get();
        $lesson_field_row = lesson_field::find($lesson_field[0]->id);
        $lesson_field_row->delete();
        
        $masters = master_vaset::where("lesson_id",$id)->get();
        
        if($masters){
            foreach($masters as $master){
                $master ->delete();
            }
        }
        $lesson ->delete();
        return redirect("lesson/index");

    }
}
