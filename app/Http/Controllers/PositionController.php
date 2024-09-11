<?php

namespace App\Http\Controllers;

use App\Models\Position;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PositionController extends Controller
{

    public function index_position(){

        $position = DB::table('positions')
                    ->join('employees','employees.emp_id','=', 'positions.emp_id')
                    ->select('positions.no','employees.emp_id','employees.emp_name','positions.name', 'positions.created_at','positions.updated_at')->get();
        $employee = DB::table('employees')->get();
        return view('position', compact('employee','position'));
    }

    public function save_position(Request $request){
        $position = new Position();
        $request->validate([
            "emp_name" => 'required',
            "position" => 'required'
        ]);

        $position->emp_id = $request->emp_name;
        $position->name = $request->position;
        $position->save();

        return redirect()->back()->with("success", "Save success..");

    }

    public function delete_pos($id){
       DB::table('positions')->where('no', $id)->delete();
       return redirect()->back()->with("delete", "Delete Success");
    }

    public function update_pos(Request $request, $id){
        $position = Position::where('no', $id)->first();
        $request->validate([
            "emp_name" => 'required',
            "position" => 'required'
        ]);

        $position->emp_id = $request->emp_name;
        $position->name = $request->position;
        $position->update();
        return redirect()->back()->with("update", "Update success..");
    }
}
