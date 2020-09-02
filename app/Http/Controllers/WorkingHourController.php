<?php

namespace App\Http\Controllers;

use App\Timeslot;
use App\WorkingHour;
use Illuminate\Http\Request;

class WorkingHourController extends Controller
{

    public function __construct()
    {
        $this->middleware('admin');
    }
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
        $hour= new WorkingHour();
        $result=$hour->dateCheck($request->start_at,$request->finish_at);
        if($result!='true')
        {
            return back()->with('error',$result);
        }

        $request->validate([
            'date'=>'required | date',
            'start_at'=>'nullable',
            'finish_at'=>'nullable |after:start_at'
        ]);

        $day=WorkingHour::create([
            'date'=>$request->date,
            'start_time'=>$request->start_at,
            'finish_time'=>$request->finish_at,
        ]);
        
        $end_time=date_create($request->finish_at)->modify('-1 hour');
        $interval = date_interval_create_from_date_string('1 hour');
        $time = date_create('07:00');

        for ($i=1; $i<=10; $i++) 
        {
            $timeslot= new Timeslot();
            $time= $time->add($interval);
           
            $timeslot->workinghours_id= $day->id;
            $timeslot->slot= $i;
            $timeslot->starts_at= $time;

            if($time < date_create($request->start_at) || $time>$end_time)
            {
                $timeslot->available = 'no';
            }
            $timeslot->save();

        }

        return redirect()->route('admin')->with('Success','Day successfully added');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\WorkingHour  $workingHour
     * @return \Illuminate\Http\Response
     */
    public function show(WorkingHour $workingHour)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\WorkingHour  $workingHour
     * @return \Illuminate\Http\Response
     */
    public function edit(WorkingHour $workingHour)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\WorkingHour  $workingHour
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, WorkingHour $workingHour)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\WorkingHour  $workingHour
     * @return \Illuminate\Http\Response
     */
    public function destroy(WorkingHour $workingHour)
    {
        //
    }
}
