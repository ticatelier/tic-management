<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
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
        ];
    }

    public function detail():HasOne
    {
        return $this->hasOne(Detail::class, 'user_id');
    }

    public function client():HasMany
    {
        return $this->hasMany(AssignTrainer::class, 'client_id');
    }

    public function trainer():HasMany
    {
        return $this->hasMany(AssignTrainer::class, 'trainer_id');
    }

    public function subscription():HasOne
    {
        return $this->hasOne(ClientSubscription::class, 'user_id');
    }

    public function attachment():HasMany
    {
        return $this->hasMany(ClientFile::class, 'user_id');
    }
}
