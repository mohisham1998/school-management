<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use App\Repository\StudentFeesInvoicesRepositoryInterface;
use Illuminate\Http\Request;

class FeeInvoicesController extends Controller
{

    protected $FeesInvoices;

    public function __construct(StudentFeesInvoicesRepositoryInterface $FeesInvoices)
    {
        $this->FeesInvoices = $FeesInvoices;
    }

    public function index()
    {
        return $this->FeesInvoices->index();
    }



    public function store(Request $request)
    {
        return $this->FeesInvoices->store($request);
    }


    public function show($id)
    {
        return $this->FeesInvoices->show($id);
    }


    public function edit($id)
    {
        return $this->FeesInvoices->edit($id);
    }


    public function update(Request $request)
    {
        return $this->FeesInvoices->update($request);
    }


    public function destroy(Request $request)
    {
        return $this->FeesInvoices->destroy($request);
    }


}
