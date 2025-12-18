<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'email_verified_at',
        'profile_image',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // =============================
    // PROFILE IMAGE URL (🔥 FIX UTAMA)
    // =============================
    public function getProfileImageUrlAttribute()
    {
        if (!$this->profile_image) {
            return null;
        }

        // Kalau sudah ada storage/
        if (str_starts_with($this->profile_image, 'storage/')) {
            return asset($this->profile_image);
        }

        return asset('storage/' . $this->profile_image);
    }

    // =============================
    // ROLE HELPERS
    // =============================
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isUser(): bool
    {
        return $this->role === 'user';
    }

    public function scopeAdmins($query)
    {
        return $query->where('role', 'admin');
    }

    public function scopeUsers($query)
    {
        return $query->where('role', 'user');
    }

    public function getRoleLabelAttribute(): string
    {
        return $this->role === 'admin' ? 'Admin' : 'User';
    }

    public function getRoleBadgeClassAttribute(): string
    {
        return $this->role === 'admin' ? 'badge bg-danger' : 'badge bg-primary';
    }
}
