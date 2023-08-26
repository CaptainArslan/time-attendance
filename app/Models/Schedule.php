<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Schedule extends Model
{

    use HasFactory;

    protected $table = 'schedules';
    protected $fillable = [
        'user_id',
        'organization_id',
        'from_date',
        'to_date',
        'required_work_hour',
        'is_open_shift',
        'is_night_shift',
    ];
}
