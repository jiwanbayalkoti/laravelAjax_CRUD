<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Student;

class StudentController extends Controller
{
    public function index(){
        return view('student.index');
    }

    public function fetchstudent(){
        $students = Student::all();
        return response()->json([
            'students'=> $students,
        ]);
    }

    public function store(Request $request){

            $validator = Validator::make($request->all(),[
                'first_name'=> 'required| max:191',
                'last_name'=> 'required | max:191',
                'email'=> 'required|email | max:191',
                'phone'=> 'required | max:191',
                'course'=> 'required | max:191'

            ]);
            if($validator->fails()){
                return response()->json([
                    'status'=> 400,
                    'errors'=> $validator->messages()
                ]);
            }else{
                  $studen = new Student;
                  $studen->fname = $request->input('first_name');
                  $studen->lname = $request->input('last_name');
                  $studen->email = $request->input('email');
                  $studen->phone = $request->input('phone');
                  $studen->course = $request->input('course');
                  $studen->save();
                  return response()->json([
                    'status'=> 200,
                    'message'=> 'Student Added Successfully.',
                ]);
            }
    }

    public function edit($id){
        $student = Student::find($id);
        if($student){
            return response()->json([
                'status'=> 200,
                'student'=> $student,
            ]);
        }else{
            return response()->json([
                'status'=> 400,
                'message'=> 'student not found'
            ]);
        }
    }

    public function update(Request $request, $id){

        $validator = Validator::make($request->all(),[
            'first_name'=> 'required| max:191',
            'last_name'=> 'required | max:191',
            'email'=> 'required|email | max:191',
            'phone'=> 'required | max:191',
            'course'=> 'required | max:191'

        ]);
        if($validator->fails()){
            return response()->json([
                'status'=> 400,
                'errors'=> $validator->messages()
            ]);
        }else{
              $student = Student::find($id);
              if($student){
                $student->fname = $request->input('first_name');
                $student->lname = $request->input('last_name');
                $student->email = $request->input('email');
                $student->phone = $request->input('phone');
                $student->course = $request->input('course');
                $student->update();
                return response()->json([
                  'status'=> 200,
                  'message'=> 'Student Updated Successfully.',
              ]);
            }else{
                return response()->json([
                    'status'=> 400,
                    'message'=> 'student not found'
                ]);
            }
             
        }
    }


    public function destroy($id){
        $student = Student::find($id);
        $student->delete();
        return response()->json([
            'status'=> 200,
            'message'=> 'Student Deleted Successfully!'
        ]);
    }
}
