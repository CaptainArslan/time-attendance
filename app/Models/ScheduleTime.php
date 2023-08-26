<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ScheduleTime extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'schedule_times';
    protected $fillable = [
        'user_id',
        'organization_id',
        'schedule_location_id',
        'code',
        'color',
        'grace_in',
        'grace_out',
        'grace_flexible',
    ];
    public function scheduleTimeDetail()
    {
        return $this->hasMany(ScheduleTimeDetail::class, 'schedule_time_id', 'id');
    }
}
