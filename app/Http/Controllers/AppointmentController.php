<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Patient;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $appointments = Appointment::paginate(10);
        return view('appointment.list',compact('appointments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $doctors = Doctor::all();
        $patients = Patient::all();
        return view('appointment.create',compact('doctors', 'patients'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $appointment = Appointment::create($input);
        return redirect('appointment/list')->with('success', 'Appointment Created Successfully.');

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $appointment = Appointment::find($id);
        $doctors = Doctor::all();
        $patients = Patient::all();
        return view('appointment.update',compact('appointment','patients','doctors'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id = $request->appointment_id;

        $appointment = Appointment::find($id);
        $appointment->doctor_id = $request->doctor_id;
        $appointment->patient_id = $request->patient_id;
        $appointment->appointment_date_time = ($request->appointment_date_time === null) ? $appointment->appointment_date_time : $request->appointment_date_time;
        $appointment->save();

        return redirect('appointment/list')->with('success', 'Appointment Updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $appointment = Appointment::find($request->appointment_id);
        $appointment->delete();
        return response()->json(['message' => "Appointment Deleted Successfull."]);
    }
}