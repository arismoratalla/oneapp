<?php

namespace Modules\HumanResource\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
    ];

    public function leaves()
    {
        return $this->hasMany(Leave::class);
    }
}
