<?php

namespace App\Http\Controllers;

use App\Models\History;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HistoryController extends Controller
{
    public function fetch_his(){
        $joinHistory = DB::table('histories')
                    ->join('employees','employees.emp_id','=','histories.emp_id')
                    ->select('histories.id','histories.emp_id','employees.emp_name','histories.position', 'histories.period','histories.work_place','histories.year')
                    ->get();

        $history = DB::table('employees')->get();
        return view("history", compact('history','joinHistory'));
    }

    public function save_history(Request $request){

        $history = new History();

        $request->validate([
            'emp_name' => 'required',
            'position' => 'required',
            'peroid' => 'required',
            'location' => 'required',
            'date_work' =>  'required',
        ]);

        $history->emp_id = $request->emp_name;
        $history->position = $request->position;
        $history->period = $request->peroid;
        $history->work_place = $request->location;
        $history->year = $request->date_work;
        $history->save();
        return redirect()->back()->with("success","Save Success...");
    }

    public function delete_history($id){

        DB::table('histories')->where('id', $id)->delete();
        return redirect()->back()->with('delete', 'Delete Success...');
    }

    public function update_history(Request $request, $id){
        $history = History::where('id', $id)->first();

        $request->validate([
            'emp_name' => 'required',
            'position' => 'required',
            'peroid' => 'required',
            'location' => 'required',
            'date_work' =>  'required',
        ]);

        $history->emp_id = $request->emp_name;
        $history->position = $request->position;
        $history->period = $request->peroid;
        $history->work_place = $request->location;
        $history->year = $request->date_work;
        $history->update();
        return redirect()->back()->with("update","Update Success...");
    }

    public function view_detail($id){
        $view =  DB::table('histories')
        ->join('employees','employees.emp_id','=','histories.emp_id')
        ->select('histories.id','histories.emp_id','employees.emp_name',
        'employees.dob','employees.phone','employees.email',
        'employees.photo','histories.position', 'histories.period',
        'histories.work_place','histories.year')->where('id', $id)->first();
        return view('view_employee',compact('view'));
    }
}
