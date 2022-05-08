<?php


namespace App\Repository;


interface StudentGraduatedRepositoryInterface
{


    public function create();
    public function index();
    public function store($request);
    public function destroy($request);
    public function update($request);


}
