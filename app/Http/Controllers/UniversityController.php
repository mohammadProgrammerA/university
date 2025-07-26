<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\university;
use App\Models\university_college;
use App\Models\college;



class UniversityController extends Controller{

    public function create(){
        return view("university.create");
    }

    public function store(Request $request){
        university::create($request ->all());
        return redirect("university/index");
    }

    public function index(){
        $universitys = university::all();
        return view("university.index",["universitys" =>$universitys]);
    }

    public function edite($id){
        $university = university::find($id);
        return view("university.edite",["university" =>$university]);
    }
    public function show($id){
        $university = university::find($id);
        return view("university.single",["university" =>$university]);
    }

    public function delete($id){
        $university = university::find($id);
        $university_colleges = university_college::where("university_id" , $id)->get();
        foreach($university_colleges as $uni_college){
            $college =college::find( $uni_college -> college_id);
            $college -> delete();
            $uni_college -> delete();

        }
        $university ->delete();
        return redirect("university/index");

    }

    public function update(Request $request){
        $university = university::find($request -> id);
      
        $university -> name = $request -> name ;
        $university -> sity = $request -> sity ;

        $university -> save();
        return redirect("university/index");

    }

    public function universitys_colleges($id){
        $university = university::find($id);
        $university_colleges = university_college::where("university_id" , $id)->get();
        $universitycolleges = [];
        foreach($university_colleges as $university_college){
            $collegeName = (college::find($university_college ->college_id)) -> name;
            $universitycolleges[$university_college ->college_id]=$collegeName;
        }
        return view("university.universityColleges",["universitycolleges" => $universitycolleges , "university" => $university]);

    }
}
