<?php

namespace App\Http\Controllers;

use App\Appointment;
use App\WorkingHour;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(Auth::user() && Auth::user()->role=='admin')
        {
            return redirect()->route('admin');
        }
        else
        {
            $slots=[];
            return view('home',compact('slots'));
        }
    }

    public function admin()
    {
        $yesterday = Carbon::yesterday();
        //fetch working days whose date from today and afterwards
        $days= WorkingHour::where('date','>','yesterday')->orderBy('date')->get();
        //fetch all working days
        $working_days= WorkingHour::get();
        //fetch all the appointment from today and afterwards
        $appointments=Appointment::where('date','>','yesterday')->orderBy('date')->get();

        return view('admin.admin',compact('working_days','days','appointments'));
    }
}
