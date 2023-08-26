<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Organization extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'user_id',
        'organization_type_id',
        'parent_id',
        'code',
        'description',
        'arabic_description',
    ];
    public function organizationType()
    {
        return $this->belongsTo(OrganizationType::class, 'organization_type_id', 'id')->select('id', 'code', 'description', 'arabic_description');
    }
    public function mainOrganization()
    {
        return $this->belongsTo(Organization::class, 'parent_id');
    }
    public function subOrganization()
    {
        return $this->hasMany(self::class, 'parent_id', 'id');
    }
}
