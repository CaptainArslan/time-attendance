<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ScheduleTimeDetail extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'schedule_time_id',
        'time_in',
        'time_out',
        'required_work_hour',
        'is_open_shift',
        'is_night_shift',
    ];
  
}
