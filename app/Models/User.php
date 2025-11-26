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
        'role',               // FIX: WAJIB ditambahkan
        'email_verified_at',  // opsional, tapi aman dimasukkan
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // ============================
    // FILTERING LOGIC
    // ============================
    public function scopeFilter($query, $filters)
    {
        // Search
        if (! empty($filters['search'])) {
            $query->where(function ($q) use ($filters) {
                $q->where('name', 'like', "%{$filters['search']}%")
                  ->orWhere('email', 'like', "%{$filters['search']}%");
            });
        }

        // Role
        if (! empty($filters['role']) && $filters['role'] !== 'all') {
            $query->where('role', $filters['role']);
        }

        // Status verifikasi email
        if (! empty($filters['status']) && $filters['status'] !== 'all') {
            if ($filters['status'] === 'verified') {
                $query->whereNotNull('email_verified_at');
            }
            if ($filters['status'] === 'unverified') {
                $query->whereNull('email_verified_at');
            }
        }

        // Sorting
        if (! empty($filters['sort'])) {
            switch ($filters['sort']) {
                case 'oldest':
                    $query->orderBy('created_at', 'asc');
                    break;
                case 'name_asc':
                    $query->orderBy('name', 'asc');
                    break;
                case 'name_desc':
                    $query->orderBy('name', 'desc');
                    break;
                default:
                    $query->orderBy('created_at', 'desc');
            }
        }

        return $query;
    }
}
