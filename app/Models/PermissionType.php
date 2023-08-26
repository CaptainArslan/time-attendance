<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PermissionType extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'user_id',
        'reason_id',
        'code',
        'description',
        'arabic_description',
        'max_permission',
        'max_minute',
        'is_official',
        'is_group_apply',
    ];
    public function reason()
    {
        return $this->belongsTo(Reason::class, 'reason_id', 'id')->select('id', 'code', 'description', 'arabic_description');
    }
}
