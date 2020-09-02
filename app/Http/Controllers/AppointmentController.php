<?php

namespace App\Http\Controllers;

use App\Timeslot;
use App\Appointment;
use App\WorkingHour;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AppointmentRequest;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'slot' =>'required| integer | min:1| max:3 '
        ]);
        
        $start_time= Timeslot::where('slot',$request->slot)->pluck('starts_at')->first();
        //dd($start_time);
        $appointment= new Appointment();
        $appointment->users_id= Auth::user()->id;
        $appointment->date= $request->date;
        $appointment->start_time= $start_time;
        $appointment->finish_time= date_create($start_time)->modify('+1 hour');
        $appointment->slot= $request->slot;
        $appointment->save();

        $id=WorkingHour::where('date',$request->date)->pluck('id')->first();
        WorkingHour::find($id)->timeslots()->where('slot',$request->slot)->update(['available'=>'appointed']);
        WorkingHour::find($id)->timeslots()->where('slot',$request->slot-1)->update(['available'=>'no']);
        WorkingHour::find($id)->timeslots()->where('slot',$request->slot+1)->update(['available'=>'no']);
        // $workingHour->timeslots->where('slot',$request->slot)->update(['available'=>'appointed']);
        // Timeslot::where('slot',$request->slot)->update(['available'=>'appointed']);
        // Timeslot::where('slot',$request->slot-1)->update(['available'=>'no']);
        // Timeslot::where('slot',$request->slot+1)->update(['available'=>'no']);
        return 'successful';
    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function show(Appointment $appointment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function edit(Appointment $appointment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Appointment $appointment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Appointment $appointment)
    {
        //
    }

    public function slotSearch(Request $request)
    {
        $request->validate([
            'date' =>' after:yesterday'
        ]);
        $days= WorkingHour::where('date',$request->date)->get();

        if(count($days)==0)
        {
            return redirect()->route('home')->with('error',"Office's day off.");
        }

        $date=$request->date;
        foreach($days as $day)
        {
            $slots=$day->timeslots->where('available', "yes");
        }
        if(count($slots)==0)
        {
            return redirect()->route('home')->with('error',"No slots available. Try for some other day");
        }
        return view('home',compact('slots','date'));
        // $slot= ;s
    }
}
