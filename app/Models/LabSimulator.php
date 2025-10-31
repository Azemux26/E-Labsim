<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LabSimulator extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
    ];

    // Relationships
    public function labschedules()
    {
        return $this->hasMany(LabSchedule::class);
    }

    // Scope methods
    public function scopeLab($query)
    {
        return $query->where('type', 'lab');
    }

    public function scopeSimulator($query)
    {
        return $query->where('type', 'simulator');
    }
}
