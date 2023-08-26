<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Nationality extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'user_id',
        'code',
        'description',
        'arabic_description',
    ];
}
