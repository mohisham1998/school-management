<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use App\Repository\LibraryRepositoryInterface;
use Illuminate\Http\Request;

class LibraryController extends Controller
{


    protected $Library;

    public function __construct(LibraryRepositoryInterface $Library) {
        $this->Library = $Library;
    }

    public function index()
    {
     return $this -> Library -> index();
    }


    public function create()
    {
        return $this -> Library -> create();
    }


    public function store(Request $request)
    {
        return $this -> Library -> store($request);
    }



    public function edit($id)
    {
        return $this -> Library -> edit($id);
    }


    public function update(Request $request)
    {
        return $this -> Library -> update($request);
    }


    public function destroy(Request $request)
    {
        return $this -> Library -> destroy($request);
    }


    public function downloadAttachment ($file_name) {
        return $this -> Library -> download($file_name);
    }
}
