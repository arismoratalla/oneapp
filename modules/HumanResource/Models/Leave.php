<?php

namespace Modules\HumanResource\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leave extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'leave_type_id',
        'start_date',
        'end_date',
        'leave_duration',
        'number_of_days',
        'reason',
        'status',
    ];

    public function leaveType()
    {
        return $this->belongsTo(LeaveType::class, 'leave_type_id', 'id');
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeFilter($query, array $filters)
    {   
        $query->when($filters['search'] ?? null, function ($query, $search) {
        // $query->when(data_get($filters, 'search'), function ($query, $search) {
            $query->where(function ($query) use ($search) {
                $query->where('reason', 'like', '%' . $search . '%')

                    ->orWhereHas('leaveType', function ($query) use ($search) {
                        $query->where('name', 'like', '%' . $search . '%');
                    })
                    ->orWhere('start_date', 'like', '%' . $search . '%')
                    ->orWhere('end_date', 'like', '%' . $search . '%');
            });
        });
    }
}
