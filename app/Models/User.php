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

    // FILTERING LOGIC
    public function scopeFilter($query, $filters)
    {
        if (! empty($filters['search'])) {
            $query->where(function ($q) use ($filters) {
                $q->where('name', 'like', "%{$filters['search']}%")
                  ->orWhere('email', 'like', "%{$filters['search']}%");
            });
        }

        if (! empty($filters['role']) && $filters['role'] !== 'all') {
            $query->where('role', $filters['role']);
        }

        if (! empty($filters['status']) && $filters['status'] !== 'all') {
            if ($filters['status'] === 'verified') {
                $query->whereNotNull('email_verified_at');
            }
            if ($filters['status'] === 'unverified') {
                $query->whereNull('email_verified_at');
            }
        }

        if (! empty($filters['sort'])) {
            switch ($filters['sort']) {
                case 'oldest':     $query->orderBy('created_at', 'asc'); break;
                case 'name_asc':   $query->orderBy('name', 'asc'); break;
                case 'name_desc':  $query->orderBy('name', 'desc'); break;
                default:           $query->orderBy('created_at', 'desc');
            }
        }

        return $query;
    }

    // ========== TAMBAHKAN METHOD BERIKUT ==========

    // Cek apakah user adalah admin
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    // Cek apakah user adalah user biasa
    public function isUser(): bool
    {
        return $this->role === 'user';
    }

    // Scope untuk query admin
    public function scopeAdmins($query)
    {
        return $query->where('role', 'admin');
    }

    // Scope untuk query user biasa
    public function scopeUsers($query)
    {
        return $query->where('role', 'user');
    }

    // Get role label
    public function getRoleLabelAttribute(): string
    {
        return $this->role === 'admin' ? 'Admin' : 'User';
    }

    // Get role badge class
    public function getRoleBadgeClassAttribute(): string
    {
        return $this->role === 'admin' ? 'badge bg-danger' : 'badge bg-primary';
    }
}
