<?php


namespace App\Repository;


use App\Models\Grade;
use App\Models\promotion;
use App\Models\Student;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class StudentGraduatedRepository implements StudentGraduatedRepositoryInterface
{


    public function create() {

       $grades = Grade::all();
        return $grades;
    }

    public function store($request)
    {

        $students = Student::where('Grade_id',$request -> Grade_id) -> where('Classroom_id',$request -> Grade_id)
            -> where('section_id',$request -> Grade_id) -> get();

        if(!$students) {
            return redirect()->back()->with('error_promotions', __('لاتوجد بيانات في جدول الطلاب'));
        }

        foreach ($students as $student) {

            $ids = explode(',' , $student -> id);
            Student::whereIn('id',$ids) -> Delete();
        }

        return $students;


    }



    public function index() {

        $students = Student::onlyTrashed()->get();
        return view('pages.Students.graduated.index',compact('students'));
    }

    public function update($request)
    {
        $flag = Student::onlyTrashed() -> where('id',$request -> id) -> restore();
        if(!$flag) {
            toastr()->error(trans('messages.Error'));
            return redirect()->back();
        }

    }


    public function destroy($request)
    {



        $flag = Student::onlyTrashed() -> where('id',$request -> id) -> forceDelete();
        if(!$flag) {
            toastr()->error(trans('messages.Error'));
            return redirect()->back();
        }

    }


}
