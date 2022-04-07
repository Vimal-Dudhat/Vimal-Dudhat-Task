<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Company;
use App\Http\Requests\EmployeeValidate;

use DataTables;


class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $employees = Employee::all();
        $companies = Company::all();

        if($request->ajax()){
            return Datatables::of($employees)
                    ->addIndexColumn()
                    ->addColumn('company', function($employee){
                            return $employee->company->name;
                    })
                    ->addColumn('action', function($employee){
     
                           $btn = '<a class="edit btn btn-primary btn-sm edit_employee" data-edit_id="' . $employee->id . '">Edit</a>
                           <a class="edit btn btn-primary btn-sm delete_employee" data-delete_id="' . $employee->id . '">Delete</a>';
    
                            return $btn;
                    })
                    ->rawColumns(['action','company'])
                    ->make(true);
        }
        return view('employee',compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\EmployeeValidate  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmployeeValidate $request)
    {
        $input = $request->all();
        $employee = Employee::create($input);
        return response()->json(["employee" => $employee,'company' => $employee->company->name]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $employee = Employee::find($request->edit_id);
        return response()->json(["employee" => $employee,'company' => $employee->company->name]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param App\Http\Requests\\EmployeeValidate  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EmployeeValidate $request)
    {
        $employee = Employee::find($request->emp_id);
        $employee->first_name = $request->first_name;
        $employee->last_name = $request->last_name;
        $employee->email = $request->email;
        $employee->phone = $request->phone;
        $employee->company_id = $request->company_id;
        $employee->save();
        return response()->json(["employee" => $employee,'company' => $employee->company->name]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $employee = Employee::find($request->delete_id);
        $employee->delete();
        return response()->json(['del_id' => $request->delete_id, 'message' => 'Employee deleted successfully.']);
    }
}
