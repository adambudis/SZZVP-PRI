<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Atributy, které je možné hromadně přiřadit (např. v `create()`).
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'favorite_genre',
    ];

    /**
     * Atributy, které budou skryté v serializaci (např. JSON).
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Atributy, které se převedou na jiné datové typy.
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function books()
    {
        return $this->hasMany(Book::class);
    }

    public function readings()
    {
        return $this->hasMany(Reading::class);
    }
}
