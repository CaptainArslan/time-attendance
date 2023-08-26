<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RamdanSchedule extends Model
{
    use HasFactory;
    protected $table = 'ramdan_schedules';
    protected $fillable=[
        'user_id',
        'description',
        'arabic_description',
        'from_date',
        'to_date'
    ];
}
