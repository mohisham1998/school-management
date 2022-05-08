<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Repository\StudentGraduatedRepositoryInterface;
use Illuminate\Http\Request;

class GraduatedController extends Controller
{

    protected $Gruadated;
    public function __construct(StudentGraduatedRepositoryInterface $Gruadated)
    {
        $this->Gruadated = $Gruadated;
    }




    public function index()
    {
      return $this -> Gruadated -> index();
    }


    public function create()
    {
     $Grades =  $this->Gruadated->create();
     return view('pages.Students.graduated.create',compact('Grades'));


    }


    public function store(Request $request)
    {
       $this -> Gruadated -> store($request);
       toastr()->success(trans('messages.success'));
       return redirect()->route('Graduated.index');

    }



    public function update(Request $request)
    {


        $this -> Gruadated -> update($request);
        toastr()->success(trans('messages.success'));
        return redirect()->back();
    }


    public function destroy(Request $request)
    {

        $this -> Gruadated -> destroy($request);
        toastr()->error(trans('messages.success'));
        return redirect()->back();
    }
}
