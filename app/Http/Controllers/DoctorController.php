<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreDoctor;
use App\Models\Doctor;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $doctors = Doctor::paginate(10);
        return view('doctor.list',compact('doctors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('doctor.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\StoreDoctor  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDoctor $request)
    {
        if ($request->email !== null) {
            $this->validate($request,[
                'email' => 'email|unique:doctors'
    		]);
        }
        $input = $request->all();
        $doctor = Doctor::create($input);
        return redirect('doctor/list')->with('success', 'Doctor Created Successfully.');

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $doctor = Doctor::find($id);
        return view('doctor.update',compact('doctor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\StoreDoctor  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreDoctor $request)
    {
        $id = $request->doc_id;

        $doctor = Doctor::find($id);
        $doctor->first_name = $request->first_name;
        $doctor->last_name = $request->last_name;
        $doctor->email = $request->email;
        $doctor->department = $request->department;
        $doctor->visit_day_time = ($request->visit_day_time === null) ? $doctor->visit_day_time : $request->visit_day_time;
        $doctor->fees = $request->fees;
        $doctor->save();

        return redirect('doctor/list')->with('success', 'Doctor Updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $doctor = Doctor::find($request->doc_id);
        $doctor->delete();
        return response()->json(['message' => "Doctor Deleted Successfull."]);
    }
}
