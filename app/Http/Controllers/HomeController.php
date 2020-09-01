<?php

namespace App\Http\Controllers;

use App\Appointment;
use App\WorkingHour;
use Illuminate\Http\Request;
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
        $working_days= WorkingHour::get();
        return view('admin.admin',compact('working_days'));
    }
}
