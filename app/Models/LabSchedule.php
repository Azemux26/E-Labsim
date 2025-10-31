<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class LabSchedule extends Model
{
     use HasFactory;

    protected $fillable = [
        'lab_simulator_id',
        'kalab_id',
        'pengajar_id',
        'tanggal',
        'jam_mulai',
        'jam_selesai',
        'jenis_kegiatan',
        'detail_materi',
        'jumlah_peserta',
        'status_verifikasi',
        'created_by',
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];

    // Relationships
    public function labSimulator()
    {
        return $this->belongsTo(LabSimulator::class);
    }

    public function kalab()
    {
        return $this->belongsTo(User::class, 'kalab_id');
    }

    public function pengajar()
    {
        return $this->belongsTo(User::class, 'pengajar_id');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function notifications()
    {
        return $this->hasMany(LabNotification::class);
    }

    // Scope methods
    public function scopeDisetujui($query)
    {
        return $query->where('status_verifikasi', 'Disetujui');
    }

    public function scopeBelumDisetujui($query)
    {
        return $query->where('status_verifikasi', 'Belum Disetujui');
    }

    public function scopeForUser($query, $userId)
    {
        return $query->where(function($q) use ($userId) {
            $q->where('created_by', $userId)
              ->orWhere('kalab_id', $userId)
              ->orWhere('pengajar_id', $userId);
        });
    }

    public function scopeFilterByTahun($query, $tahun)
    {
        return $query->whereYear('tanggal', $tahun);
    }

    // Custom methods
    public function isDisetujui()
    {
        return $this->status_verifikasi === 'Disetujui';
    }

    public function getRentangWaktuAttribute()
    {
        return $this->jam_mulai . ' - ' . $this->jam_selesai;
    }
}
