<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Holiday extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'code',
        'description',
        'arabic_description',
        'from_date',
        'to_date',
        'is_recurring',
    ];
}
