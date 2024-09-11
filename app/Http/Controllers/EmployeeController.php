<?php

namespace App\Http\Controllers;

use App\Models\Employee;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class EmployeeController extends Controller
{
    public function index(){

        $employee = DB::table('employees')->get();
        return view('index', compact('employee'));
    }

    public function save_employee(Request $request){

        $employee = new Employee();
        $request->validate([
            'photo' => 'required|image|mimes:png,jpg|max:2048'
        ]);

        $employee->emp_name = $request->empname;
        $employee->age = $request->age;
        $employee->gender = $request->gender;
        $employee->phone = $request->phone;
        $employee->email = $request->email;
        $employee->dob = $request->dob;
        $employee->address = $request->address;

        
        $extension = $request->file('photo')->extension();
        $filename = date("YmdHis"). '.' . $extension;
        $request->file('photo')->move(public_path('upload/'), $filename);
        $employee->photo = $filename;
        $employee->save();
        return redirect()->back()->with("success", "Save Successfull...");
    }

    //delete employee
    public function delete_employee($id){

        $delete = Employee::where('emp_id', $id)->first();
        $image_path = public_path('upload/' .  $delete->photo);
        if(file_exists($image_path)){
            unlink($image_path);
        }
        $delete->delete();
        return redirect()->back()->with("delete","Delete Success...");

    }

    public function update_employee(Request $request, $id){
        $employee = Employee::where('emp_id', $id)->first();
        $request->validate([
            'photo' => 'image|mimes:png,jpg|max:2048'
        ]);

        $employee->emp_name = $request->empname;
        $employee->age = $request->age;
        $employee->gender = $request->gender;
        $employee->phone = $request->phone;
        $employee->email = $request->email;
        $employee->dob = $request->dob;
        $employee->address = $request->address;

        if($request->hasFile('photo')){
            $destination = "upload/" . $employee->photo;
            if(File::exists($destination)){
                File::delete($destination);
            }

            $file = $request->file('photo');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('upload/', $filename);
            $employee->photo = $filename;
        }
        else{
            $employee->photo = $request->photo1;
        }
        $employee->update();
        return redirect()->back()->with("update", "Update Success...");

    }


}
