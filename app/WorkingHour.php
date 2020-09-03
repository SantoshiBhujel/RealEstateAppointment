<?php

namespace App;

use App\Timeslot;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WorkingHour extends Model
{
    use SoftDeletes;

    protected $fillable = ['date', 'start_time', 'finish_time'];

    public function timeslots()
    {
        return $this->hasMany(Timeslot::class, 'workinghours_id', 'id');
    }

    public function dateCheck($start,$finish)
    {
        if(date_create($start)>=date_create($finish))
        {
            return 'Finish must be greater than start time';
        }
        if(date_create($start)->modify('+1 hour')>date_create($finish))
        {
            return 'Finish must be greater than start time by at least one hour.';
        }
        return true;
    }


    public function dateAvailableOrNot($date)
    {
        $dates= WorkingHour::where('date',$date)->get();
        return $dates;
    }

    public function getWorkingDaysFromToday()
    {
        $days= WorkingHour::where('date','>','yesterday')->orderBy('date')->get();
        return $days;
    }
}
