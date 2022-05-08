<?php

namespace App\Http\Controllers\Classrooms;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClassroomRequest;
use App\Models\Classroom;
use App\Models\Grade;
use Illuminate\Http\Request;

class ClassroomController extends Controller
{

    public function index()
    {
      $My_Classes = Classroom::all();
      $Grades = Grade::all();
      return view('pages.My_Classes.My_Classes',compact('My_Classes','Grades'));
    }


    public function create()
    {
        //
    }


    public function store(ClassroomRequest $request)
    {



        try {
            $classes = $request -> List_Classes;
            foreach ($classes as $class) {
                $classroom = new Classroom();
                $classroom -> Name_Class = ['ar' => $class['Name'] , 'en' => $class['Name_class_en']];
                $classroom -> grade_id = $class['Grade_id'];
                $classroom -> save();
            }

            toastr()->success(trans('messages.success'));
            return redirect()->route('Classrooms.index');

        }


        catch (\Exception $ex) {
            return redirect()->back()->withErrors(['error' => $ex->getMessage()]);
        }



    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request)
    {
        try {
            $Classrooms = Classroom::findOrFail($request->id);
            $Classrooms->update([

                $Classrooms->Name_Class = ['ar' => $request->Name, 'en' => $request->Name_en],
                $Classrooms->Grade_id = $request->Grade_id,
            ]);
            toastr()->success(trans('messages.Update'));
            return redirect()->route('Classrooms.index');
        }

        catch
        (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }


    public function destroy(Request $request)
    {
        $Classrooms = Classroom::findOrFail($request->id)->delete();
        toastr()->error(trans('messages.Delete'));
        return redirect()->route('Classrooms.index');
    }


    public function delete_all(Request $request)
    {
        $delete_all_id = explode(",", $request->delete_all_id);

        Classroom::whereIn('id', $delete_all_id)->Delete();
        toastr()->error(trans('messages.Delete'));
        return redirect()->route('Classrooms.index');
    }


    public function Filter_Classes($id)
    {
        $Grades = Grade::all();
        $Search = Classroom::select('*')->where('Grade_id','=',$id)->get();
        return view('pages.My_Classes.My_Classes',compact('Grades'))->withDetails($Search);

    }


}
