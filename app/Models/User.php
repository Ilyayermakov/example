<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Carbon;


class User extends Authenticatable implements MustVerifyEmail

{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    public function isAdmin()
    {
        return $this->admin === 1;
    }

    public function isActive()
    {
        return $this->active === 1;
    }

    protected $attributes = [
        'admin' => false,
        'active' => false,
    ];

    protected $fillable = [
        'name', 'email', 'avatar',
        'active', 'password', 'admin',
        'email_verified_at',
    ];
    protected $hidden = [
        'password',
        'remember_token',
    ];
}
