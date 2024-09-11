<?php

namespace App\Http\Controllers;

use App\Models\Salary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SalaryController extends Controller
{
    public function salary(){

        $salary = DB::table("salaries")
            ->join('employees','employees.emp_id', '=', 'salaries.emp_id')
            ->join('positions','positions.no','=', 'salaries.p_id')
            ->select('salaries.sid','employees.emp_name','positions.no','employees.emp_id','positions.name','salaries.amount','salaries.period','salaries.created_at')
            ->get();

        $employee = DB::table('employees')->get();
        $position = DB::table('positions')->get();
        return view('salary',compact('employee', 'position','salary'));
    }

    public function save_salary(Request $request){

        $salary = new Salary();
        $request->validate([
            'amount' => 'required',
            'emp_name' => 'required',
            'position' => 'required',
            'period' => 'required'
        ]);

        $salary->amount = $request->amount;
        $salary->emp_id = $request->emp_name;
        $salary->p_id = $request->position;
        $salary->period = $request->period;
        $salary->save();

        return redirect()->back()->with('success', "Save Successfull...");

    }

    public function delete_salary($id){
        DB::table('salaries')->where('sid', $id)->delete();
        return redirect()->back()->with("delete", "Delete Success...");
    }

    public function update_salary(Request $request, $id){
        $salary =  Salary::where('sid', $id)->first();;
        $request->validate([
            'amount' => 'required',
            'emp_name' => 'required',
            'position' => 'required',
            'period' => 'required'
        ]);

        $salary->amount = $request->amount;
        $salary->emp_id = $request->emp_name;
        $salary->p_id = $request->position;
        $salary->period = $request->period;
        $salary->update();

        return redirect()->back()->with('update', "Update Successfull...");
    }
}
