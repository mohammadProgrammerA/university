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
use App\Models\master;
use App\Models\master_vaset;

class MasterController extends Controller
{
    public function create(){
        $unis = university::all();
        $allData=[];
        foreach($unis as $uni){
            $allData[$uni -> id]["uni_data"] = $uni;
            $uni_colleges = university_college::where("university_id" , $uni -> id) -> get();

            foreach($uni_colleges as $uni_college){
                $college = college::find($uni_college ->college_id);
                $allData[$uni -> id]["colleges"][$college -> id]["college_data"]=$college ->name;

                $college_fields = college_fieldStudy::where("college_id" , $college ->id) -> get();
               
                foreach($college_fields as $college_field){
                    $field = fieldStudy :: find($college_field -> fieldStudy_id);
                    $allData[$uni -> id]["colleges"][$college -> id]["fields"][$field -> id]["field_data"]=$field ->name;

                    $field_lessons = lesson_field::where("field_id" , $field -> id) -> get();

                   
                    foreach($field_lessons  as $field_lesson){
                         $lesson = lesson ::find($field_lesson -> lesson_id);
                        
                            $allData [$uni -> id]["colleges"][$college -> id]["fields"][$field -> id]["lessons"][$lesson -> id]=$lesson -> name;
                            
                       
                        
                    }
                }
            }
        }

        return view("master/create",["allData" => $allData]);
    }

    public function store(Request $request){
        $master_id =master:: insertGetId([
                        "name" => $request -> name
                   ]);
            $unis = $request -> unis;
            foreach($unis as $uni_id => $uni){
                foreach($uni as $college_id => $college){
                    foreach($college as $field_id => $field){
                        foreach($field as $lesson_id => $lesson){
                            master_vaset::create([
                                "master_id"=>$master_id,
                                 "uni_id"=>$uni_id,
                                 "lesson_id" =>$lesson_id,
                                 "college_id"=>$college_id,
                                 "field_id" => $field_id
                            ]);
                            
                        }
                    }
                }
            }
        return redirect("master/index");  
    }



    public function index(){
        $allMasters = master::all();
        $masters=[];
        foreach($allMasters as $master){
            $master_vasets = master_vaset::where("master_id" , $master -> id) -> get();
            // dd($master_vasets -> toArray());
            $masters [$master -> id]["master_info"]=$master;
            foreach($master_vasets as $master_vaset){
                $uni = university::find($master_vaset -> uni_id);
                $masters [$master -> id]["uni"][$uni -> id]["uni_info"]=$uni;

                $college = college::find($master_vaset -> college_id);
                $masters [$master -> id]["uni"][$uni -> id]["college"][$college -> id]["college_info"]=$college;


                $field = fieldStudy::find($master_vaset -> field_id);
                $masters [$master -> id]["uni"][$uni -> id]["college"][$college -> id]["fields"][$field -> id]["field_info"]=$field;

                $lesson = lesson::find($master_vaset -> lesson_id);
                $masters [$master -> id]["uni"][$uni -> id]["college"][$college -> id]["fields"][$field -> id]["lessons"][$lesson ->id]=$lesson;

            }
        }
        // dd($masters);
        return view("master/index",["masters"=>$masters]);
    }

    public function show($id){
        $master= master::find($id);
        $master_vasets = master_vaset::where("master_id" , $master -> id) -> get();
           
            $master_info ["master_info"]=$master;
           
            foreach($master_vasets as $master_vaset){
                $uni = university::find($master_vaset -> uni_id);
                $master_info ["uni"][$uni -> id]["uni_info"]=$uni;

                $college = college::find($master_vaset -> college_id);
                $master_info ["uni"][$uni -> id]["college"][$college -> id]["college_info"]=$college;


                $field = fieldStudy::find($master_vaset -> field_id);
                $master_info ["uni"][$uni -> id]["college"][$college -> id]["fields"][$field -> id]["field_info"]=$field;

                $lesson = lesson::find($master_vaset -> lesson_id);
                $master_info["uni"][$uni -> id]["college"][$college -> id]["fields"][$field -> id]["lessons"][$lesson ->id]=$lesson;

            }
           
             
        return view("master/single",["master_info"=>$master_info]);

    }



    public function delete($id){
        $master= master::find($id);
        $master_vasets = master_vaset::where("master_id" , $master -> id) -> get();
        foreach($master_vasets as $master_vaset){
            $master_vaset -> delete();
        }
        $master -> delete();
        return redirect("master/index");
    }


    public function edite($id){
        $idArr = explode("_",$id);

        if(count($idArr) > 1){
             $master= master::find($idArr[0]);
            $master_vasets = master_vaset::where("master_id" , $master -> id) -> get();

            $master_edite ["master_info"]=$master;

            foreach($master_vasets as $master_vaset){
                $uni = university::find($master_vaset -> uni_id);
                $master_edite ["uni"][$uni -> id]["uni_info"]=$uni;

                $college = college::find($master_vaset -> college_id);
                $master_edite ["uni"][$uni -> id]["college"][$college -> id]["college_info"]=$college;


                $field = fieldStudy::find($master_vaset -> field_id);
                $master_edite ["uni"][$uni -> id]["college"][$college -> id]["fields"][$field -> id]["field_info"]=$field;

                $lesson = lesson::find($master_vaset -> lesson_id);
                $master_edite["uni"][$uni -> id]["college"][$college -> id]["fields"][$field -> id]["lessons"][$lesson ->id]=$lesson;

            }

            $unis = university::all();
            foreach($unis as $uni){

                $allData[$uni -> id]["uni_data"] = $uni;

                $uni_colleges = university_college::where("university_id" , $uni -> id) -> get();

                foreach($uni_colleges as $uni_college){

                    $college = college::find($uni_college ->college_id);
                    $allData[$uni -> id]["colleges"][$college -> id]["college_data"]=$college ->name;

                    $college_fields = college_fieldStudy::where("college_id" , $college ->id) -> get();
                
                    foreach($college_fields as $college_field){
                        $field = fieldStudy :: find($college_field -> fieldStudy_id);
                        $allData[$uni -> id]["colleges"][$college -> id]["fields"][$field -> id]["field_data"]=$field ->name;

                        $field_lessons = lesson_field::where("field_id" , $field -> id) -> get();

                    
                        foreach($field_lessons  as $field_lesson){
                            $lesson = lesson ::find($field_lesson -> lesson_id);
                            
                                $allData [$uni -> id]["colleges"][$college -> id]["fields"][$field -> id]["lessons"][$lesson -> id]=$lesson -> name;
                                
                        
                            
                        }
                    }
                }
            }
            // dd($allData);
            return view("master/edite",["allData" => $allData ,"master_edite" => $master_edite]);
        }



        if(count($idArr) == 1){
            $master= master::find($idArr[0]);
            $master_vasets = master_vaset::where("master_id" , $master -> id) -> get();

            $master_edite ["master_info"]=$master;
            foreach($master_vasets as $master_vaset){
                $uni = university::find($master_vaset -> uni_id);
                $master_edite ["uni"][$uni -> id]["uni_info"]=$uni;

                $college = college::find($master_vaset -> college_id);
                $master_edite ["uni"][$uni -> id]["college"][$college -> id]["college_info"]=$college;


                $field = fieldStudy::find($master_vaset -> field_id);
                $master_edite ["uni"][$uni -> id]["college"][$college -> id]["fields"][$field -> id]["field_info"]=$field;

                $lesson = lesson::find($master_vaset -> lesson_id);
                $master_edite["uni"][$uni -> id]["college"][$college -> id]["fields"][$field -> id]["lessons"][$lesson ->id]=$lesson;

            }
        
           $allData=[];
            foreach($master_vasets as $master_vaset){
                $uni = university::find($master_vaset -> uni_id);
                $allData[$master_vaset -> uni_id]["uni_data"]=$uni;
                $uni_colleges = university_college::where("university_id" , $uni -> id) -> get();

                foreach($uni_colleges as $uni_college){

                    $college = college::find($uni_college ->college_id);    
                    $allData[$uni -> id]["colleges"][$college -> id]["college_data"]=$college ->name;

                    $college_fields = college_fieldStudy::where("college_id" , $college ->id) -> get();

                    foreach($college_fields as $college_field){
                        $field = fieldStudy :: find($college_field -> fieldStudy_id);
                        $allData[$uni -> id]["colleges"][$college -> id]["fields"][$field -> id]["field_data"]=$field ->name;

                        $field_lessons = lesson_field::where("field_id" , $field -> id) -> get();

                        foreach($field_lessons  as $field_lesson){
                            $lesson = lesson ::find($field_lesson -> lesson_id);

                            $allData [$uni -> id]["colleges"][$college -> id]["fields"][$field -> id]["lessons"][$lesson -> id]=$lesson -> name;

                        }

                    }

                }

                
            }
            // dd($master_edite);
            return view("master/edite",["allData" => $allData ,"master_edite" => $master_edite]);
            
        }

    }



    public function update(Request $request){
        $master= master::find($request -> id);
        $master -> name = $request ->name;
        $master ->save();

        $master_vasets = master_vaset::where("master_id" , $master -> id) -> get();
        foreach($master_vasets as $master_vaset){
            $master_vaset -> delete();
        }
        
    $unis = $request -> unis;
            foreach($unis as $uni_id => $uni){
                foreach($uni as $college_id => $college){
                    foreach($college as $field_id => $field){
                        foreach($field as $lesson_id => $lesson){
                            master_vaset::create([
                                "master_id"=>$request -> id,
                                 "uni_id"=>$uni_id,
                                 "lesson_id" =>$lesson_id,
                                 "college_id"=>$college_id,
                                 "field_id" => $field_id
                            ]);
                            
                        }
                    }
                }
            }
        return redirect("master/index");
    }
}


