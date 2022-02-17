<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use DB;
use Response;

class EmployeeController extends Controller
{
  
  
  public function employee(Request $request)
  {
    //dd($request);
    $skip = $request->skip;
    $limit = $request->limit;
    $employee = Employee::skip($skip)->take($limit)->get();
    $totalRecordCount = $this->totalCountRecords();
    $response['data'] = $employee;
    $response['totalCount'] = $totalRecordCount;

    return Response::json($response);
  }

  public function addEmployee(Request $request)
  {
         $file = $request->file('file');
         $uploadPath = 'image';
         $filename = $file->getClientOriginalName();
         $file->move($uploadPath,$filename);
         $employeeData = json_decode($request->data,true);
         $employeeData['image'] = $filename;
         $employee =Employee::create($employeeData);
         return Response::json(['message'=>'Employee Records Added Successfully.']);
  }

  public function totalCountRecords()
  {
        return $count = Employee::count(); 
  }

  public function deleteEmployee(Request $request, $id)
  {
       $employee = Employee::find($id);
       $employee->delete();
       return Response::json(['message'=>"Employee Delete Successfully."]); 

  }

   public function updateEmployee(Request $request, $id)
  {
       
         $employeedata = $request->all();
         $employee =  Employee::find($id);
         $employee->name = $employeedata['name'];
         $employee->email = $employeedata['email'];
         $employee->salery = $employeedata['salery'];
         $employee->hobby = $employeedata['hobby'];
         $employee->save();
         return Response::json(['message'=>'Employee Records Updated Successfully.']);

  }


   public function getEmployee(Request $request, $id)
  {
      
       $getEmployee =  $employee =  Employee::where('id', $id)->first();
       return $getEmployeeJson = Response::json($getEmployee);
       

  }

}
