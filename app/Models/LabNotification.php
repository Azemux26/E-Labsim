<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LabNotification extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'schedule_id',
        'message',
        'status',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function labschedule()
    {
        return $this->belongsTo(LabSchedule::class, 'schedule_id');
    }

    // Scope methods
    public function scopeTerkirim($query)
    {
        return $query->where('status', 'terkirim');
    }

    public function scopeGagal($query)
    {
        return $query->where('status', 'gagal');
    }
}
