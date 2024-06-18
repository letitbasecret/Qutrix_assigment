<?php

namespace App\Http\Controllers;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;



class StudentController extends Controller
{
    public function store (request $request){

        $validator = Validator::make($request->all(), [
            'name' =>'required',
            'email' =>'required|email',
            'phone' =>'required|numeric',
            'address' =>'required',
            'city' =>'required',
            'country' =>'required',
            'gender' =>'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'error'=>$validator->errors()], 401);
        }


        $student = new Student();
        $student->name = $request->name;
        $student->email = $request->email;
        $student->save();

        return response()->json([
            "message"=>"Data stored successfully",
            'data'=>$student,
            "status"=>true,
        ], 201);


    }
    public function show(){
        $student = Student::all();

        if(!$student){
            return response()->json([
                "message"=>"students not found",
                "status"=>false,
            ], 404);

        }

        return response()->json([
            "message"=>"student Data",
            'data'=>$student,
            "status"=>true,
        ], 201);
    }

    public function stuDetail($id){
        $student = Student::find($id);
        if(!$student){
            return response()->json([
                "message"=>"student Data not found",
                "status"=>false,
            ], 404);

        }
        return response()->json([
            "message"=>"student Data",
            'data'=>$student,
            "status"=>true,
        ], 201);

    }

}
