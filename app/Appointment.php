<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $fillable = ['users_id','date', 'start_time', 'finish_time','slot'];

    public function user()
    {
        return $this->belongsTo('App\User', 'users_id', 'id');
    }
}
