<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'api_token'
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'api_token'
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function createAuthToken(): array
    {
        $plainTextToken = Str::random(60);

        $this->forceFill([
            'api_token' => hash('sha256', $plainTextToken),
        ])->save();

        return [
            'token' => $plainTextToken,
            'user' => $this,
        ];
    }

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }
}
