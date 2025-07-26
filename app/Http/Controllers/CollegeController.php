<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\college;
use App\Models\university;
use App\Models\university_college;
use App\Models\fieldStudy;
use App\Models\college_fieldStudy;

class CollegeController extends Controller
{
    public function create(){
        $universitys = university::all();
        return view("college.create" , ["universitys" => $universitys]);
    }

    public function store(Request $request){
        $college_id = college::insertGetId(
            ["name" => $request -> name]
        );
        university_college::create(
            ["university_id" => $request -> university_id ,
              "college_id" => $college_id 
            ]
        );

        return redirect("college/index");
    }

    public function index(){
        $colleges = college::all();
        foreach($colleges as $college){
           $university_college =university_college::where("college_id",$college->id) -> get();
           $university = university::find($university_college[0]->university_id);
           $college["university"] = $university -> name;
        }
        return view("college.index",["colleges" =>$colleges]);
    }
    
    public function show($id){
        $college = college::find($id);
        $university_college = university_college::where("college_id" , $id)->get();
        
        $university =university::find($university_college [0]->university_id);
        
        return view("college.single",["college" =>$college ,"university"=> $university]);
    }

    public function edite($id){
        $college = college::find($id);
        $universitys = university::all(); 
        $university_college = university_college::where("college_id" , $id)->get();
        // dd($university_college);
        return view("college.edite",["college" =>$college  , "universitys" => $universitys ,"university_college" => $university_college]);
    }

    public function delete($id){
        $college = college::find($id);
        $college ->delete();
        $university_college = university_college::where("college_id" , $id)->get();
        

         foreach($university_college as $uni){
            $uni = university_college::find($uni ->id);
           
            $uni -> delete();
        }
        return redirect("college/index");

    }

    public function collegesFields($id){
        $college = college::find($id);

        $colleges_fields = college_fieldStudy::where("college_id" , $id)->get();
        
        $collegesFields = [];
        foreach($colleges_fields as $colleges_field){
            $fieldName = (fieldStudy::find($colleges_field ->fieldStudy_id)) -> name;
            $collegesFields[$colleges_field ->fieldStudy_id]=$fieldName;
        }
        return view("college.collegesFields",["college" => $college , "collegesFields" => $collegesFields]);

    }

    public function update(Request $request){
        $college = college::find($request -> id);
        $college -> name = $request -> name ;
        // $university_college = university_college::where("college_id" , $request ->id)->get();
        // foreach($university_college as $uni){
            $uni = university_college::find($request ->id);
            $uni -> university_id = $request -> university_id;
            $uni -> save();
        // }

        $college -> save();
        return redirect("college/index");

    }


}   
