<?php

namespace App;

use App\WorkingHour;
use Illuminate\Database\Eloquent\Model;

class Timeslot extends Model
{
    protected $fillable = ['workinghours_id', 'start_time'];

    public function workinghour()
    {
        return $this->belongsTo(WorkingHour::class, 'workinghours_id', 'id');
    }
}
