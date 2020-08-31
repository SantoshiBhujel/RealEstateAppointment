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
}
