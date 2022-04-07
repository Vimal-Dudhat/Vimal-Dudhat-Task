<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StorePatient;
use App\Models\Patient;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $patients = Patient::paginate(10);
        return view('patient.list',compact('patients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('patient.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Storepatient  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Storepatient $request)
    {

        if ($request->phone !== null) {
            $this->validate($request,[
    			'phone' => 'digits:10',
    		]);
        }
        if ($request->aadhar_no !== null) {
            $this->validate($request,[
    			'aadhar_no' => 'digits:12',
    		]);
        }
        $input = $request->all();
        $patient = Patient::create($input);

        $data = [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
        ];
       
        \Mail::to('admin@admin.com')->send(new \App\Mail\PatientCreateMail($data));

        return redirect('patient/list')->with('success', 'Patient Created Successfully. And Mail Sent To Your Email Address.');

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $patient = Patient::find($id);
        return view('patient.update',compact('patient'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Storepatient  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Storepatient $request)
    {
        $id = $request->patient_id;

        $patient = Patient::find($id);
        $patient->first_name = $request->first_name;
        $patient->last_name = $request->last_name;
        $patient->email = $request->email;
        $patient->phone = $request->phone;
        $patient->age = $request->age;
        $patient->address = $request->address;
        $patient->aadhar_no = $request->aadhar_no;
        $patient->save();

        return redirect('patient/list')->with('success', 'Patient Updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $patient = Patient::find($request->patient_id);
        $patient->delete();
        return response()->json(['message' => "Patient Deleted Successfull."]);
    }
}
