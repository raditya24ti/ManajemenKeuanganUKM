<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'phone',
        'address',
        'is_active',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
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
            'is_active' => 'boolean',
        ];
    }

    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }

    public function budgets(): HasMany
    {
        return $this->hasMany(Budget::class, 'created_by');
    }

    public function fundRequests(): HasMany
    {
        return $this->hasMany(FundRequest::class, 'requested_by');
    }

    public function memberDues(): HasMany
    {
        return $this->hasMany(MemberDue::class);
    }

    public function notifications(): HasMany
    {
        return $this->hasMany(AppNotification::class);
    }

    public function auditTrails(): HasMany
    {
        return $this->hasMany(AuditTrail::class);
    }

    public function isKetua(): bool
    {
        return $this->role === 'ketua';
    }

    public function isBendahara(): bool
    {
        return $this->role === 'bendahara';
    }

    public function isPengurus(): bool
    {
        return $this->role === 'pengurus';
    }

    public function isAnggota(): bool
    {
        return $this->role === 'anggota';
    }

    public function canApprove(): bool
    {
        return in_array($this->role, ['ketua', 'bendahara']);
    }
}
