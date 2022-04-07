<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CompanyValidate;
use Illuminate\Http\Request;
use App\Models\Company;
use DataTables;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = Company::all();

        return Datatables::of($companies)
                    ->addIndexColumn()
                    ->addColumn('action', function($company){
     
                           $btn = '<a class="edit btn btn-primary btn-sm edit_company" data-edit_id="' . $company->id . '">Edit</a>
                           <a class="edit btn btn-primary btn-sm delete_company" data-delete_id="' . $company->id . '">Delete</a>';
    
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);

        return response()->json(['companies' => $companies]);
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
     * @param  App\Http\Requests\CompanyValidate  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CompanyValidate $request)
    {
        $input = $request->all();
        dd($request->all());
        $companies = Company::create($input);
        return response()->json(["company" => $companies]);
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
        $company = Company::find($request->edit_id);
        return response()->json(["company" => $company]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\CompanyValidate  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CompanyValidate $request)
    {
        dd($request->all());
        $company = Company::find($request->company_id);
        $company->name = $request->name;
        $company->website = $request->website;
        $company->email = $request->email;
        $company->contact = $request->contact;
        $company->address = $request->address;
        $company->save();
        return response()->json(["company" => $company]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $company = Company::find($request->delete_id);
        $company->delete();
        return response()->json(['del_id' => $request->delete_id, 'message' => 'Company deleted successfully.']);
    }
}
