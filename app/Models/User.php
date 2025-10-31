<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Laravel\Fortify\TwoFactorAuthenticatable;

class User extends Authenticatable 
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, TwoFactorAuthenticatable;


    /**
 * App\Models\User
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\LabSchedule[] $labschedulesAsKalab
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\LabSchedule[] $labschedulesAsPengajar
 */

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'password',      // ← URUTAN SESUAI MIGRATION
        'no_whatsapp',   // ← SETELAH PASSWORD  
        'role_id',          // ← SETELAH NO_WHATSAPP
        'email',         // ← SETELAH ROLE
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
   protected $hidden = [
        'password',
        'two_factor_secret',
        'two_factor_recovery_codes',  // ← TYPO DIPERBAIKI
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'two_factor_confirmed_at' => 'datetime',
        ];
    }

    /**
     * Get the user's initials
     */
    public function initials(): string
    {
        return Str::of($this->name)
            ->explode(' ')
            ->take(2)
            ->map(fn ($word) => Str::substr($word, 0, 1))
            ->implode('');
    }


// ==================== RELATIONSHIPS ====================
    
        public function role()
        {
            return $this->belongsTo(Role::class);
        }

        public function labschedulesCreated()
        {
            return $this->hasMany(LabSchedule::class, 'created_by');
        }

        public function labschedulesAsKalab()
        {
            return $this->hasMany(LabSchedule::class, 'kalab_id');
        }

        public function labschedulesAsPengajar()
        {
            return $this->hasMany(LabSchedule::class, 'pengajar_id');
        }

        public function labnotifications()
        {
            return $this->hasMany(LabNotification::class);
        }

        public function scopePengajar($query)
        {
            return $query->whereHas('role', function($q) {
                $q->where('name', 'pengajar');
            });
        }

        public function scopeKalab($query)
        {
            return $query->whereHas('role', function($q) {
                $q->where('name', 'ka.lab');
            });
        }

        public function scopeAdmin($query)
        {
            return $query->whereHas('role', function($q) {
                $q->where('name', 'admin');
            });
        }

    // ==================== HELPERS ====================
        public function isAdmin()
        {
            // ✅ NULL SAFETY CHECK
            if (!$this->role) {
                // Load role jika belum diload
                $this->load('role');
            }
            
            return $this->role && $this->role->name === 'admin';
        }

        public function isPengajar()
        {
            if (!$this->role) {
                $this->load('role');
            }
            
            return $this->role && $this->role->name === 'pengajar';
        }

        public function isKalab()
        {
            if (!$this->role) {
                $this->load('role');
            }
            
            return $this->role && $this->role->name === 'ka.lab';
        }
}