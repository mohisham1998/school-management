<?php


namespace App\Repository;

use App\Models\Fee;
use App\Models\FeeInvoices;
use App\Models\Grade;
use App\Models\Student;
use App\Models\StudentAccount;
use Illuminate\Support\Facades\DB;

class StudentFeesInvoicesRepository implements StudentFeesInvoicesRepositoryInterface
{


    public function index()
    {
        $Fee_invoices = FeeInvoices::all();
        $Grades = Grade::all();
        return view('pages.Fees_Invoices.index', compact('Fee_invoices', 'Grades'));
    }


    public function show($id)
    {

        $student = Student::findorfail($id);
        $fees = Fee::where('Grade_id', $student->Grade_id)->get();
        return view('pages.Fees_Invoices.add', compact('student', 'fees'));

    }


    public function store($request)
    {
        DB::beginTransaction();

        try {
            $List_Fees = $request->List_Fees;
            foreach ($List_Fees as $List_Fee) {
                // حفظ البيانات في جدول فواتير الرسوم الدراسية

                $Fees = new FeeInvoices();
                $Fees->invoice_date = date('Y-m-d');
                $Fees->student_id = $request->student_id;
                $Fees->Grade_id = $request->Grade_id;
                $Fees->Classroom_id = $request->Classroom_id;
                $Fees->fee_id = $List_Fee['fee_id'];
                $Fees->description = $List_Fee['description'];
                $fee_amount = Fee::select('amount')->where('id', $List_Fee['fee_id'])->first();
                $Fees->amount = $fee_amount->amount;
                $Fees->save();

                // حفظ البيانات في جدول حسابات الطلاب
                $StudentAccount = new StudentAccount();
                $StudentAccount->date = date('Y-m-d');
                $StudentAccount->type = 'invoice';
                $StudentAccount->fee_invoice_id = $Fees->id;
                $StudentAccount->student_id = $request->student_id;
                $StudentAccount->Debit = $Fees->amount;
                $StudentAccount->credit = 0.00;
                $StudentAccount->description = $List_Fee['description'];
                $StudentAccount->save();
            }
            DB::commit();
            toastr()->success(trans('messages.success'));
            return redirect()->route('Fees_Invoices.index');
        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $ex->getMessage()]);
        }


    }


    public function edit($id)
    {
        $fee_invoices = FeeInvoices::findorfail($id);
        $fees = Fee::where('Classroom_id', $fee_invoices->Classroom_id)->get();
        return view('pages.Fees_Invoices.edit', compact('fee_invoices', 'fees'));
    }

    public function update($request)
    {
        DB::beginTransaction();
        try {
            $FeeInvoice = FeeInvoices::findorfail($request->id);
            $FeeInvoice->fee_id = $request->fee_id;
            $fee_amount = Fee::select('amount')->where('id', $request->fee_id)->first();
            $FeeInvoice->amount = $fee_amount->amount;
            $FeeInvoice->description = $request->description;
            $FeeInvoice->save();
            // تعديل البيانات في جدول حسابات الطلاب
            $StudentAccount = StudentAccount::where('fee_invoice_id',$request->id)->first();
            $StudentAccount->Debit =  $FeeInvoice->amount;
            $StudentAccount->description = $request->description;
            $StudentAccount->save();
            DB::commit();
            toastr()->success(trans('messages.Update'));
            return redirect()->route('Fees_Invoices.index');
        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $ex->getMessage()]);
        }
    }

    public function destroy($request)
    {

        try {
            DB::beginTransaction();
            StudentAccount::where('fee_invoice_id',$request -> id) -> delete();
            FeeInvoices::destroy($request->id);
            DB::commit();
            toastr()->error(trans('messages.Delete'));
            return redirect()->back();
        }

        catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }


}
