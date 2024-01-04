<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Employees extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = ['first_name', 'last_name', 'companies_id', 'email', 'phone_no', 'profile_image'];
    protected $hidden = [
        'password'
    ];
    protected $guard = 'employees';

    public function Companies(): BelongsTo
    {
        return $this->belongsTo(Companies::class);
    }
}
