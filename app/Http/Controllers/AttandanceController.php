<?php

namespace App\Http\Controllers;

use App\Models\Attancedace;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Contracts\Service\Attribute\Required;

class AttandanceController extends Controller
{
    public function attace_pos(){


        $attandance = DB::table("attancedaces")
                        ->join('employees','employees.emp_id','=','attancedaces.emp_id')
                        ->join('positions', 'positions.no','=', 'attancedaces.p_id')
                        ->select("attancedaces.at_id","employees.emp_id","positions.no",
                        "employees.emp_name","positions.name","attancedaces.status",'attancedaces.description','attancedaces.created_at')
                        ->get();

        $employee = DB::table('employees')->get();
        $position = DB::table('positions')->get();

        return view('attandance',compact('employee','position', 'attandance'));
    }

    public function save_att(Request $request){

        $attancedance = new Attancedace();
        $request->validate([
            'emp_name' => 'required',
            'position' => 'required',
            'status' => 'required',
            'des' => 'required'
        ]);

        $attancedance->emp_id = $request->emp_name;
        $attancedance->p_id = $request->position;
        $attancedance->status = $request->status;
        $attancedance->description = $request->des;
        $attancedance->save();
        return redirect()->back()->with("success", "Save Success...");

    }

    //delete attancedance

    public function delete_att($id){
        DB::table('attancedaces')->where('at_id', $id)->delete();
        return redirect()->back()->with('delete', 'Delete Success...');
    }

    public function update_att(Request $request, $id){
        $attancedance = Attancedace::where('at_id', $id)->first();
        $request->validate([
            'emp_name' => 'required',
            'position' => 'required',
            'status' => 'required',
            'des' => 'required'
        ]);

        $attancedance->emp_id = $request->emp_name;
        $attancedance->p_id = $request->position;
        $attancedance->status = $request->status;
        $attancedance->description = $request->des;
        $attancedance->update();
        return redirect()->back()->with('edit', "Update Success...");
    }

}
